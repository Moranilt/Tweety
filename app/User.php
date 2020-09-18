<?php

namespace App;

use App\Support\Collection;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Tweet;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sharedTweets()
    {
        return $this->belongsToMany(Tweet::class, 'shared_tweets', 'user_id', 'tweet_id')->withTimestamps();
    }

    public function share(Tweet $tweet)
    {
        return $this->sharedTweets()->save($tweet);
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_user');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getAvatarAttribute($value)
    {
      return asset($value ? "/storage/{$value}" : '/images/default-avatar.jpeg');
    }

    public function timeline()
    {
        $friends = $this->follows()->pluck('id');

        $friendsTweets = Tweet::whereIn('user_id', $friends)->orWhere('user_id', current_user()->id)->withLikes()->get();

        foreach($friends as $friend){
            $friendsSharedTweetId = User::find($friend)->sharedTweets->pluck('id');

            $tweets = Tweet::withCount(['likes' => function(Builder $query){
                        $query->where('liked', '=', '1');
                    }])->whereIn('id', $friendsSharedTweetId)->get();

                foreach ($tweets as $tweet) {
                    $pivot = $tweet->sharedTweet->pluck('pivot');

                        foreach ($pivot->all() as $p) {
                            if($p->user_id != current_user()->id){
                                Arr::add($tweet, 'sharedPivot', $p);
                            }
                        }
                    $friendsTweets->push($tweet->sharedPivot);
                }

        }

        return (new Collection($friendsTweets->sortByDesc('created_at')))->paginate(5);
        //ddd($tweets3, $friendsTweets->sortByDesc('created_at'));



//      $friends = $this->follows()->pluck('id');
//      $sharedTweets = $this->sharedTweets()->pluck('tweet_id');
//      $tweets=[];
//        foreach($friends as $friend)
//        {
//            $tweets[] = $this->find($friend)->sharedTweets->pluck('id');
//        }
//
//        return Tweet::whereIn('user_id', $friends)
//            ->orWhere('user_id', $this->id)
//            ->orWhereIn('id', $sharedTweets)
//            ->orWhereIn('id', $tweets)
//            ->withLikes()
//            ->latest()
//            ->paginate(5);
    }

    public function tweets()
    {
      return $this->hasMany(Tweet::class)->latest();
    }

    public function path($append = '')
    {
      $path = route('profile', $this->username);

      return $append ? "{$path}/{$append}" : $path;
    }

//    public function setPasswordAttribute($value)
//    {
//      $this->attributes['password'] = bcrypt($value);
//    }

}
