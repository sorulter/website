<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Track;
use App\User;
use Carbon\Carbon;
use Hashids;

class TrackerController extends Controller
{
    /**
     * Log ad source name and redirect to register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function ad($name)
    {
        session(['ad_source' => $name]);
        $this->track('ad', $name);

        return redirect()->route('register');
    }

    /**
     * Log ad source name and redirect to register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function promote($name)
    {
        session(['ad_source' => $name]);
        $this->track('promote', $name);

        return redirect()->route('register');
    }

    /**
     * Save the track.
     */
    private function track($type, $name)
    {
        session(['referrer', request()->server('HTTP_REFERER')]);
        $tracker = Track::firstOrNew([
            'day' => Carbon::now()->toDateString(),
            'type' => $type,
            'source' => $name,
            'ip' => request()->ip(),
        ]);

        $tracker->day = Carbon::now()->toDateString();
        $tracker->type = $type;
        $tracker->source = $name;
        $tracker->referrer = request()->server('HTTP_REFERER');
        $tracker->ip = request()->ip();
        $tracker->count += 1;
        $tracker->save();
        session(['track_id' => $tracker->id]);
    }

    public function invitation($hash)
    {
        $uid = Hashids::connection('invitation')->decode($hash)[0];

        $tracker = Track::firstOrNew([
            'day' => Carbon::now()->toDateString(),
            'type' => 'user',
            'source' => $uid,
            'ip' => request()->ip(),
        ]);

        $tracker->day = Carbon::now()->toDateString();
        $tracker->type = 'user';
        $tracker->source = $uid;
        $tracker->referrer = request()->server('HTTP_REFERER');
        $tracker->ip = request()->ip();
        $tracker->count += 1;
        $tracker->save();

        $user = User::find($uid);
        $email = $this->cut($user->email);
        $invitation_msg = trans('base.invitation_by_user', ['email' => $email]);
        session(['invitation_id' => $uid]);
        session(['invitation_msg' => $invitation_msg]);

        return redirect()->route('register');
    }

    private function cut($email)
    {
        $arr = mb_split('@', $email);
        $size = mb_strlen($arr[0]);
        if ($size > 4) {
            return $arr[0][0] . $arr[0][1] . '***' . $arr[0][$size - 1] . '@' . $arr[1];
        } else {
            return '***@' . $arr[1];
        }
    }
}
