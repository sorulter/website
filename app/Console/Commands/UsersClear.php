<?php

namespace app\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class UsersClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean not activate users';

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
        // dd(date('Y-m-01 00:00:03', time()));
        User::where('activate', '=', 1)->get()->each(function ($user) {
            $flows = $user->flows;
            if ($flows->updated_at <= date('Y-m-01 00:00:03', time())
                and ($flows->forever + $flows->combo + $flows->extra) <= env('FREE_FLOWS')
                and $user->activate == 1) {
                $user->port->user_id = 0;
                $user->activate = -2;

                $user->save();
                $user->port->save();
            }
        });
    }
}
