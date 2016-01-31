<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;

class ActivationController extends Controller
{
    /**
     * Display activation result.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActivate(Request $request, $token)
    {
        $user = User::where('activate_code', '=', $token)->where('activate', '=', '0')->first();
        if ($user != null) {
            $user->activate();

            return view('pub.redirect')->withType('success')
                ->withTitle('Activate Success!')
                ->withContent('')
                ->withTo('/login')
                ->withTime(3);
        } else {
            return view('pub.msg')->withType('danger')
                ->withTitle('Failed!')
                ->withContent('Activation link is invalid or has activated.');
        }
    }

    /**
     * Resend activation link.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSend(Request $request)
    {
        // Check login status
        if (Auth::guest()) {
            session()->put('redirectPath', '/activate/send');
            return redirect('login');
        }

        // Check activate status
        if ($request->user()->activate) {
            return redirect('user');
        }

        // resend
        $token = Str::random(60);
        $user = $request->user();
        Mail::laterOn('default', 10, 'emails.welcome', array('code' => $token), function ($message) use ($user) {
            $name = mb_split('@', $user->email)[0];
            $message->to($user->email, $name)->subject('Activate your iProxier account,' . $name);
        });
        $user->activate_code = $token;
        $user->save();
        return view('pub.msg')->withType('success')->withTitle('Success!')->withContent('Send activate link mail success.');

    }
}
