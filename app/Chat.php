<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsToMany(User::class, 'chat_user', 'chat_id', 'user_id');
    }

    public function conversation()
    {
        return $this->hasMany(Conversation::class);
    }

    public function chatTo()
    {
//        $usernames = $this->user->pluck('username');
//        $author_username = $usernames->search(auth()->user()->username);
//        $username = $usernames->except([$author_username]);
//        return $username->first();

        return $this->user()->get()->except(current_user()->id)->first()->pivot->user_id;
    }
}
