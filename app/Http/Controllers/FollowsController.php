<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        //have the auth'd user follow the given user
        // if (auth()->user()->following($user)) {
        //     auth()->user()->unfollow($user);
        // } else {
        //     auth()->user()->follow($user);
        // }
        auth()->user()->toggleFollow($user);
        return back()->with('success', 'You have followed/unfollowed this user');
    }
}
