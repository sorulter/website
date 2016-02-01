<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Mail;
use Swift_Mailer;
use Swift_SmtpTransport as SmtpTransport;

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

        // set special mail poster
        if (in_array(mb_split("@", $to->email)[1], ["qq.com", "foxmail.com"])
            && env('MAIL_HOST') && env('MAIL_PORT') && env('MAIL_USERNAME') && env('MAIL_PASSWORD')) {
            // Backup your default mailer
            $default_mailer = Mail::getSwiftMailer();

            // Setup backup mailer
            $transport = SmtpTransport::newInstance(env('MAIL_HOST'), env('MAIL_PORT'), env('MAIL_ENCRYPTION'));
            $transport->setUsername(env('MAIL_USERNAME'));
            $transport->setPassword(env('MAIL_PASSWORD'));
            // Any other mailer configuration stuff needed...

            $backup_mailer = new Swift_Mailer($transport);

            // Set the mailer to use
            Mail::setSwiftMailer($backup_mailer);

            // Send your message
            Mail::laterOn('default', 10, 'emails.msg', ['user' => $to, 'title' => $title, 'msg' => $msg], function ($m) use ($to) {
                $m->from(env('MAIL_USERNAME'), config('mail.from.name'));
                $m->to($to->email);
                $m->subject('Your Message from master at ' . date('Y-m-d h:i:s T'));
            });

            // Restore your original mailer
            Mail::setSwiftMailer($default_mailer); # code...

        } else {
            Mail::laterOn('default', 10, 'emails.msg', ['user' => $to, 'title' => $title, 'msg' => $msg], function ($m) use ($to) {
                $m->to($to->email)->subject('Your Message from master at ' . date('Y-m-d h:i:s T'));
            });
        }

        return redirect()->back()->with('msg', 'send mail success.');
    }

}
