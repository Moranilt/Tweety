<?php

namespace App\Http\Controllers;

use App\Tweet;
//use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Support\Collection;
use App\User;

class ProfilesController extends Controller
{
    public function show(User $user)
    {

        $sharedId = $user->sharedTweets->pluck('id');
        $createdAtPivot = $user->sharedTweets->pluck('pivot.tweet_id', 'pivot.created_at');

        $sharedTweets = Tweet::whereIn('id', $sharedId)->withLikes()->get();
        $new2 = collect();

        foreach($sharedTweets as $tweet){
            $created_at_origin = $tweet->created_at;
            Arr::set($tweet, 'origin_created_at', $created_at_origin);
            foreach($createdAtPivot as $key => $value){
                if($tweet->id == $value) {
                    Arr::forget($tweet, 'created_at');
                    Arr::set($tweet, 'created_at', $key);
                }
            }

            $new2->push($tweet);

        }
        $tweets2 = Tweet::where('user_id', $user->id)->withLikes()->get();
        $new = $tweets2->merge($new2);
        $tweets = (new Collection($new->sortByDesc('created_at')))->paginate(5);
        //ddd($tweets);
        //$tweets = Tweet::where('user_id', $user->id)->orWhereIn('id', $shared)->latest()->withLikes()->paginate(5);


      return view('profiles.show', [
          'user' => $user,
          'tweets' => $tweets
      ]);
    }

    public function edit(User $user)
    {
      return view('profiles.edit', compact('user', $user));
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'username' => [
                'string',
                'required',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($user)
            ],
            'avatar' => ['file'],
            'name' => ['string', 'required', 'max:255'],
            'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed'],
            'description' => ['string']
        ]);
      if(request('avatar')){
        $attributes['avatar'] = request('avatar')->store('avatars');
      }
      $attributes['password'] = Hash::make($attributes['password']);

      $user->update($attributes);

      return redirect($user->path());
    }
}
