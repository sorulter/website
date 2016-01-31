<?php

namespace App\Console\Commands;

use App\Model\Flows;
use Carbon\Carbon;
use Illuminate\Console\Command;
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
        // if ($today->ne($first)) {
        //     Log::warning('Only can be run at first day of the month.');
        //     return;
        // }

        $flows = Flows::all();
        Log::info("user flows info backup: {$flows}");

        foreach ($flows as $flow) {

            $overflow = $flow->used - ($flow->free + $flow->combo_flows);
            $raw = clone $flow;

            // 1. Enough or overflow.
            if ($overflow >= 0) {
                $flow->used = $overflow;
                $flow->free = 0;
            }

            // 2. Not used all,but combo is enough or overflow.
            if ($overflow < 0 && $raw->used >= $raw->combo_flows) {
                $flow->free = $flow->free - $flow->used + $flow->combo_flows;
                $flow->used = 0;
            }

            // 3. Combo is not used all.
            if ($overflow < 0 && $raw->used < $raw->combo_flows) {
                $flow->used = 0;
            }

            // User no combo flows.
            if ($flow->combo_end_date < $today) {
                exec("say 'user no combo flows.'");
                $flow->combo_flows = 0;
            }

            // Store to db.
            $flow->save();
        }
        Log::info('Have reset flows of all users.');
    }
}
