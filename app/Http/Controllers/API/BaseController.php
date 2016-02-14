<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\ApiToken;
use App\User;

class BaseController extends Controller
{
    protected $user;
    public function __construct()
    {
        $token = ApiToken::where('token', '=', request()->token)->first();
        $this->user = User::find($token->user_id);
    }
}
