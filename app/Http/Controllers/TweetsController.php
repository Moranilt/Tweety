<?php

namespace App\Http\Controllers;

use App\Events\UserFollowed;
use Illuminate\Http\Request;
use App\Tweet;

class TweetsController extends Controller
{
    public function main()
    {
        return view('welcome');
    }

    public function index()
    {
        return view('tweets.index', [
          'tweets' => auth()->user()->timeline()
        ]);
    }

    public function store()
    {
      $attributes = request()->validate(['body' => 'required|max:255'], ['photo' => ['file']]);
      if(request('photo')) {
          $attributes['photo'] = request('photo')->store('tweets');
      }
      $attributes['user_id'] = auth()->user()->id;

      $tweet = new Tweet();
//      Tweet::create([
//        'user_id' => auth()->id(),
//        'body' => $attributes['body'],
//          'photo' => $attributes['photo']
//      ]);
        $tweet->create($attributes);

      return redirect()->route('home');
    }
}
