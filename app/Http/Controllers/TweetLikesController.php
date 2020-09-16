<?php

namespace App\Http\Controllers;

use App\Notifications\TweetLiked;
use App\Tweet;
use App\User;
use Illuminate\Support\Facades\Notification;

class TweetLikesController extends Controller
{
    public function store(Tweet $tweet)
    {


        if($tweet->isLikedBy(auth()->user()) > 0){
            $tweet->dislike(auth()->user());
        }else{
            $tweet->like(current_user());
            if($tweet->user->id != auth()->user()->id){
                $author = $tweet->user->notify(new TweetLiked($tweet));
            }

            //$author->notify(new TweetLiked($tweet));
           // Notification::send($author, new TweetLiked($tweet));
        }

        $likes = $tweet->likes()->where('liked', '1')->count();

        return response()->json(['message' => 'You liked it', 'count_likes' => $likes]);
        //return back();
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->dislike(current_user());

        return back();
    }
}
