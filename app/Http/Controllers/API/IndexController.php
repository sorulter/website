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

}
