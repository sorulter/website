<?php

namespace app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Pacs;

class SettingsController extends Controller
{
    /**
     * Display settings index.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('user.settings.index')
            ->withTitle(trans('settings.system'))
            ->withAct('index');
    }

    public function getPAC()
    {
        $pacs = new Pacs;
        $items = json_decode($pacs->where('user_id', '=', request()->user()->id)->get(['rules'])[0]['rules']);

        return view('user.settings.pac')
            ->withTitle(trans('settings.pac'))
            ->withItems($items)
            ->withAct('PAC');
    }

    public function getRemovePAC($id)
    {
        $pacs = Pacs::where('user_id', '=', request()->user()->id)->first();

        $items = json_decode($pacs->rules);

        $domain = "";

        foreach ($items as $k => $v) {
            if (mb_substr(md5($k + env('APP_KEY')), 8, 16) == $id) {
                unset($items->{$k});
                $domain = $k;
                break;
            }
        }
        $pacs->rules = json_encode($items);

        if ($pacs->save()) {
            return redirect()->back()->withMsg(trans('settings.remove_rule_success', ['domain' => $domain]));
        } else {
            return redirect()->back()->withMsg(trans('settings.remove_rule_failed', ['domain' => $domain]));
        }
    }
}
