<?php

namespace App\Http\Controllers\API;

use App;
use App\Model\ApiToken;
use Auth;
use Illuminate\Support\Str;

class IndexController extends BaseController
{

    /**
     * login and return user data.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $api = (object) [
            'status' => 200,
            'message' => 'login success.',
            'data' => null,
        ];

        if (Auth::attempt(['email' => request()->email, 'password' => request()->password])) {
            $user = Auth::user();

            // Generate token and store.
            $token = ApiToken::find($user->id);
            if ($token == null) {
                $token = new ApiToken;
            }
            $token->user_id = $user->id;
            $token->token = Str::random(60);
            $token->save();

            $api->data = $token->token;
        } else {
            $api->status = 404;
            $api->message = 'email or password error.';
        }

        return response()->json($api);
    }

    /**
     * show account info.
     *
     * return \Illuminate\Http\Respone
     */
    public function account()
    {
        $api = (object) [
            'status' => 200,
            'message' => 'success.',
            'data' => null,
        ];

        if ($this->user == null) {
            $api->status = 500;
            $api->message = "invalid token.";
        } else {
            $data = [
                'id' => App\id2hash($this->user->id),
                'email' => $this->user->email,
                'node' => $this->user->port->node_name,
                'port' => $this->user->port->port,
                'used' => $this->user->flows->used,
                'free' => $this->user->flows->forever,
                'combo_flows' => $this->user->flows->combo,
                'combo_end_date' => $this->user->flows->combo_end_date,
            ];
            $api->data = (object) $data;
        }
        return response()->json($api);
    }

}
