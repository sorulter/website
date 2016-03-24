<?php

namespace App\Console\Commands;

use App\Model\LogsA;
use App\Model\LogsB;
use App\Model\LogsC;
use App\Model\LogsD;
use App\Model\LogsE;
use Carbon\Carbon;
use Illuminate\Console\Command;
use League\Csv\Writer;
use Log;

class ClearLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all logs.';

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
            Log::warning('[logs:clear]Only can be run at first day of the month.');
            return;
        }

        $time = date('Y-m', time() - 7200);
        @mkdir(storage_path() . '/used');
        $csv = Writer::createFromPath(new \SplFileObject(storage_path() . "/used/logs_{$time}.csv", 'a+'));
        $csv->insertOne(['id', 'used', 'ip', 'node', 'time']);

        LogsA::all()->each(function ($log) use ($csv) {
            $csv->insertOne($log->toArray());
        });
        LogsB::all()->each(function ($log) use ($csv) {
            $csv->insertOne($log->toArray());
        });
        LogsC::all()->each(function ($log) use ($csv) {
            $csv->insertOne($log->toArray());
        });
        LogsD::all()->each(function ($log) use ($csv) {
            $csv->insertOne($log->toArray());
        });
        LogsE::all()->each(function ($log) use ($csv) {
            $csv->insertOne($log->toArray());
        });

        // delete
        LogsA::where('used_at', 'like', "%{$time}%")->delete();
        LogsB::where('used_at', 'like', "%{$time}%")->delete();
        LogsC::where('used_at', 'like', "%{$time}%")->delete();
        LogsD::where('used_at', 'like', "%{$time}%")->delete();
        LogsE::where('used_at', 'like', "%{$time}%")->delete();
    }
}
