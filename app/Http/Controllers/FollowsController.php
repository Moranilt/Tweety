<?php

namespace App\Http\Controllers;

use App\Events\UserFollowed;
use App\Notifications\FollowingUsers;
use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        //UserFollowed::dispatch('Jon');


        //event(new UserFollowed($user));
        //return response()->json(['text' => 'You are done!']);
        //event(new UserFollowed($user));
        $user->notify(new FollowingUsers($user));
        auth()->user()->toogleFollow($user);
        if(current_user()->following($user)){
            $btn_msg = 'Unfollow me';
            $message = 'You are following now';
        }else{
            $btn_msg = 'Follow me';
            $message = 'You unfollowed';
        }

        return response()->json(['message1' => $message, 'btn_msg' => $btn_msg]);
        //return back();
    }

    public function show()
    {

        $followers_id = auth()->user()->followers()->pluck('id');
        $followers = User::whereIn('id', $followers_id)->paginate('30');
        $count_followers = $followers->count();
        return view('followers.show', [
            'followers' => $followers,
            'count_followers' => $count_followers
        ]);
    }
}
