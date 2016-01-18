<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    /**
     * Display users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $users = new User;
        return view('admin.users.index')->withUsers($users->paginate(env('PERPAGE')));
    }

    /**
     * Manual activate user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActivate($id)
    {
        $user = User::find($id);
        if ($user != null) {
            $user->activate = 1;
            $user->save();
        }
        return redirect()->back();
    }

}
