<?php

namespace app\Console\Commands;

use App\Model\Flows;
use Carbon\Carbon;
use Illuminate\Console\Command;
use League\Csv\Writer;
use Log;

class ResetFlows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flows:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset flows of all users.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today = Carbon::today(config()->get('app.timezone'));
        $first = Carbon::today(config()->get('app.timezone'))->firstOfMonth();

        // Only can be run at first day of the month.
        if ($today->ne($first)) {
            Log::warning('Only can be run at first day of the month.');
            return;
        }

        $time = date('Y-m', time() - 720000);
        @mkdir(storage_path() . '/used');
        $csv = Writer::createFromPath(new \SplFileObject(storage_path() . "/flows/flows_log_{$time}.csv", 'a+'));
        $csv->insertOne(['user_id', 'used', 'forever', 'combo', 'extra', 'combo_end_date', 'created_at', 'updated_at']);

        Flows::chunk(100, function ($flows) use ($today, $csv) {
            foreach ($flows as $flow) {
                $csv->insertOne($flow->toArray());

                $overflow = $flow->used - ($flow->forever + $flow->combo + $flow->extra);
                $raw = clone $flow;

                // 1. Enough or overflow.
                if ($overflow >= 0) {
                    $flow->used = $overflow;
                    $flow->forever = 0;
                }

                // 2. Not used all,but combo is enough or overflow.
                if ($overflow < 0 && $raw->used >= $raw->combo + $raw->extra) {
                    $flow->forever = $flow->forever - $flow->used + $flow->combo + $flow->extra;
                    $flow->used = 0;
                }

                // 3. Combo is not used all.
                if ($overflow < 0 && $raw->used < $raw->combo) {
                    $flow->used = 0;
                }

                // User no combo flows.
                if ($flow->combo_end_date <= $today) {
                    $flow->combo = 0;
                }

                $flow->extra = 0;

                // Store to db.
                $flow->save();
            }
        });

        Log::info('Have reset flows of all users.');
    }
}
