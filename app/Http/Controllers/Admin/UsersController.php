<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendMsgEmail;
use App\User;

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
        return view('admin.users.index')->withUsers($users->paginate(env('PERPAGE')));
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

        $job = (new SendMsgEmail(request()->get('title'), request()->get('msg'), User::find($id)))->delay(10);
        $this->dispatch($job);
        return redirect()->back()->with('msg', 'send mail success.');
    }

}
