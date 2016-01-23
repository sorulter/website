<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use Swift_Mailer;
use Swift_SmtpTransport as SmtpTransport;

class SendMsgEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user, $title, $msg;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $msg, $user)
    {
        $this->title = $title;
        $this->msg = $msg;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $user = $this->user;

        // set special mail poster
        if (in_array(mb_split("@", $user->email)[1], ["qq.com", "foxmail.com"])) {
            echo "USE SMTP\n";
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
            $mailer->send('emails.msg', ['user' => $user, 'title' => $this->title, 'msg' => $this->msg], function ($m) use ($user) {
                $m->from(env('MAIL_USERNAME'), config('mail.from.name'));
                $m->to($user->email);
                $m->subject('Your Message from master at ' . date('Y-m-d h:i:s T'));
            });

            // Restore your original mailer
            Mail::setSwiftMailer($default_mailer); # code...
            return;
        }

        $mailer->send('emails.msg', ['user' => $user, 'title' => $this->title, 'msg' => $this->msg], function ($m) use ($user) {
            $m->to($user->email)->subject('Your Message from master at ' . date('Y-m-d h:i:s T'));
        });
    }
}
