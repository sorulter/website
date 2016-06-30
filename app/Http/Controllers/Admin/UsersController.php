<?php

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Flows;
use App\Model\Order;
use App\User;
use Carbon\Carbon;
use Mail;

class UsersController extends Controller
{
    /**
     * Display users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $users = new User;
        return view('admin.users.index')->withUsers($users->orderBy('id', 'DESC')->paginate(env('PERPAGE')));
    }

    /**
     * Display users list of combo.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCombo()
    {
        $users = new User;
        return view('admin.users.index')->withUsers($users->whereHas('flows', function ($q) {
            $q->where('combo_end_date', '>', date('Y-m-d', time()));
        })->orderBy('id', 'DESC')->paginate(env('PERPAGE')));
    }

    /**
     * Display users list of forever flows.
     *
     * @return \Illuminate\Http\Response
     */
    public function getForever()
    {
        $users = new User;
        return view('admin.users.index')->withUsers($users->whereHas('flows', function ($q) {
            $q->where('forever', '>', env('FREE_FLOWS'));
        })->orderBy('id', 'DESC')->paginate(env('PERPAGE')));
    }

    /**
     * Display users list who has bought last 2 month.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBought()
    {
        $users = new User;
        return view('admin.users.index')->withUsers($users->whereHas('flows', function ($q) {
            $q->where('combo_end_date', '>', Carbon::now()->subMonths(2))
                ->where('combo_end_date', '<', Carbon::now()->addMonth()->toDateString());
        })->orderBy('id', 'DESC')->paginate(env('PERPAGE')));
    }

    /**
     * Manual activate user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActivate($id)
    {
        $user = User::find($id);
        if ($user != null) {
            $msg = $user->activate();
        }
        return redirect()->back()->with('msg', $msg);
    }

    /**
     * Send mail to user.
     *
     */
    public function getSendMail($id)
    {
        return view('admin.users.sendmail')->with('toUser', User::find($id));
    }

    /**
     * Send mail.
     *
     */
    public function postSendMail($id)
    {
        $this->validate(request(), [
            'title' => 'required',
            'msg' => 'required',
        ]);

        $to = User::find($id);
        $title = request()->title;
        $msg = request()->msg;

        Mail::laterOn('default', 10, 'emails.msg', ['user' => $to, 'title' => $title, 'msg' => $msg], function ($m) use ($to) {
            $m->to($to->email)->subject(trans('email.notification', ['date' => date('Y-m-d h:i:s T')]));
        });

        return redirect()->back()->with('msg', 'send mail success.');
    }

    public function getGift($id)
    {
        return view('admin.users.gift')->with('toUser', User::find($id));
    }

    public function postGift($id)
    {
        $this->validate(request(), [
            'flows' => 'required',
        ]);
        $to = User::find($id);
        $flows = request()->flows;
        $title = trans('base.gift_to_user', ['flows' => $flows]);
        $msg = trans('base.gift_msg', ['flows' => $flows, 'email' => $to->email]);

        // Gift forever flows.
        $order = new Order;
        $order->order(0, $to->id);
        $order->flows_type = 'extra';
        $order->flows_amount = $flows;
        $order->state = 'TRADE_FINISHED';
        $order->save();

        $flowsModel = Flows::where('user_id', '=', $to->id)->first();
        $flowsModel->extra += $flows * MB;
        $flowsModel->save();

        Mail::laterOn('default', 10, 'emails.msg', ['user' => $to, 'title' => $title, 'msg' => $msg], function ($m) use ($to, $title) {
            $m->to($to->email)->subject($title);
        });

        return redirect()->back()->with('msg', 'gift flows success.');
    }
}
