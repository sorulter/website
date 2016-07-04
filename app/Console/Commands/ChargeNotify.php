<?php

namespace app\Console\Commands;

use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class ChargeNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'charge:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nofiy users to charge.';

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
        $users = User::whereHas('flows', function ($q) {
            $q->where('combo_end_date', '>', Carbon::today()->subMonths(2)->format('Y-m-01'))
                ->where('combo_end_date', '<', Carbon::today()->addMonth()->format('Y-m-01'))
                ->where(DB::raw('combo + forever + extra'), '<', env('FREE_FLOWS'));
        })->orderBy('id', 'DESC')->get();
    }
}
