<?php

namespace App\Listeners;

use App\Events\UserFollowed;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FollowNotify
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserFollowed  $event
     * @return void
     */
    public function handle(UserFollowed $event)
    {

//        if(auth()->user()->following($event->user)) {
//            auth()->user()->unfollow($event->user);
//            var_dump('You unfollowed');
//        }else{
//            auth()->user()->follow($event->user);
//            var_dump('You followed success!');
//        }

        //var_dump('oh my');

        response()->json(['text' => 'You subscriped!']);

    }
}
