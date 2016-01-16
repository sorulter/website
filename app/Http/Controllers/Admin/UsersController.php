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
        return view('admin.users.index')->withUsers($users->paginate(2));
    }

}
