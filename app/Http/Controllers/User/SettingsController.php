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
        $pacs = Pacs::where('user_id', '=', request()->user()->id)->first();

        return view('user.settings.index')
            ->withTitle(trans('settings.system'))
            ->withPacs($pacs)
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
            if (mb_substr(md5($k), 8, 16) == $id) {
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

    public function postAddPAC()
    {
        if (parse_url(request()->input('domain'), PHP_URL_SCHEME) == null) {
            $domain = parse_url('http://' . request()->input('domain'), PHP_URL_HOST);
        } else {
            $domain = parse_url(request()->input('domain'), PHP_URL_HOST);
        }

        if (!$domain) {
            return redirect()->back()->withMsg(trans('settings.invalid_URL', ['domain' => $domain]));
        }

        $pacs = Pacs::where('user_id', '=', request()->user()->id)->first();
        $items = json_decode($pacs->rules);
        if (sizeof((array) $items) >= env('CUSTOM_PAC_LIMIT')) {
            return redirect()->back()->withMsg(trans('settings.limit_rules_number', ['no' => env('CUSTOM_PAC_LIMIT')]));
        }

        $items->{$domain} = 1;
        $pacs->rules = json_encode($items);

        if ($pacs->save()) {
            return redirect()->back()->withMsg(trans('settings.add_rule_success', ['domain' => $domain]));
        } else {
            return redirect()->back()->withMsg(trans('settings.add_rule_failed', ['domain' => $domain]));
        }
    }
}
