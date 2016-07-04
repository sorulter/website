<?php

namespace app\Console\Commands;

use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Mail;

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
            $q->where('combo_end_date', '>=', Carbon::today()->subMonths(2)->format('Y-m-01'))
                ->where('combo_end_date', '<', Carbon::today()->addMonth()->format('Y-m-01'))
                ->where(DB::raw('combo + forever + extra'), '<=', env('FREE_FLOWS'));
        })->orderBy('id', 'DESC')->get();

        $title = trans('email.charge_notify_title');
        $btn = trans('email.charge_notify_btn');

        foreach ($users as $k => $user) {
            $args = ['user' => $user, 'title' => $title, 'msg' => trans('email.charge_notify_msg', ['email' => $user->email]),
                'btn_title' => $btn, 'btn_link' => '/user/mall'];
            Mail::laterOn('default', 10, 'emails.msg', $args, function ($m) use ($user, $title) {
                $m->to($user->email)->subject($title);
            });
        }
    }
}
