<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class ShareTweetsController extends Controller
{
    public function store(Tweet $tweet)
    {
        $user = current_user();
        $user->share($tweet);

        return redirect()->route('home');
    }
}
