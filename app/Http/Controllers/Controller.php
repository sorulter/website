<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Mail;
use Route;
use Session;
use View;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // global variables of view
        View::share('user', Session::get('user'));
        if (Route::getCurrentRoute()) {
            list(, $action) = explode('@', Route::getCurrentRoute()->getActionName());
            View::share('action', $action);
        }
    }

    /**
     * Send activate mail
     *
     * @since 2015-11-24 00:07:50
     *
     * return
     */
    public function sendActivateMail()
    {
        $User = new User;
        $code = $User->activateCode();
        if (mb_strlen($code) == 32) {
            $data = [
                'email' => Session::get('user.email'),
                'code' => $code,
                'data' => date('c'),
            ];
            Mail::send('emails.welcome', $data, function ($message) {
                $email = Session::get('user.email');
                $message->from('notifications@iProxier.com', 'iProxier Notifications');
                $message->to($email, explode('@', $email)[0])->subject('Activate your iProxier account to start surfing! @' . date('c'));
            });
            $User->setLastSendMailTime(time());
            // return response()->json(['ok' => true, 'msg' => 'Send mail success.Please check your mail.']);
            return true;
        } else {
            // return response()->json(['ok' => false, 'msg' => 'Send mail failed.Try again later.']);
            return false;
        }
    }
}
