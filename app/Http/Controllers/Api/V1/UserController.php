<?php

namespace app\Http\Controllers\Api\V1;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use JWTAuth;

/**
 * User resource representation.
 *
 * @Resource("User", uri="/user")
 */
class UserController extends Controller
{
    use Helpers;

    /**
     * User login
     *
     * User login by email and password.
     *
     * @Get("/login")
     * @Versions({"v1"})
     */
    public function login()
    {
        // grab credentials from the request
        $credentials = request()->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => trans('api.v1.invalid_credentials'), 'status_code' => 401], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['message' => trans('api.v1.could_not_create_token'), 'status_code' => 500], 500);
        }

        // all good so return the token
        $message = trans('api.v1.login_success');
        $status_code = 200;
        return response()->json(compact('message', 'status_code', 'token'));
    }
    }
}
