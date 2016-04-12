<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Track;
use Carbon\Carbon;

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

}
