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
        $tracker = Track::firstOrNew([
            'day' => Carbon::now()->toDateString(),
            'type' => 'ad',
            'source' => $name,
            'ip' => request()->ip(),
        ]);

        $tracker->day = Carbon::now()->toDateString();
        $tracker->type = 'ad';
        $tracker->source = $name;
        $tracker->source = $name;
        $tracker->ip = request()->ip();
        $tracker->count += 1;
        $tracker->save();

        session(['ad_source' => $name]);

        return redirect()->route('register');
    }

}
