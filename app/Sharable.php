<?php

namespace App;

trait Sharable{

    public function sharedTweet()
    {
        return $this->belongsToMany(User::class, 'shared_tweets', 'tweet_id', 'user_id')->withTimestamps();
    }

    public function isSharedBy(User $user)
    {
        return $user->sharedTweets()->where('tweet_id', $this->id)->exists();
    }

    public function isShared()
    {
        return $this->sharedTweet()->exists();
    }

    public function sharedBy()
    {

       $user_id = $this->sharedTweet()->pluck('user_id');
        //$user_id = $this->sharedPivot['user_id'];
        return User::find($user_id);
    }


}


?>
