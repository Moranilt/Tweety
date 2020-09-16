<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tweet extends Model
{
    use Likable, Sharable;
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

//    public function toArray()
//    {
//        return [
//          'created_at' => $this->whenPivotLoaded('shared_tweets', function(){
//              return $this->pivot->created_at;
//          })
//        ];
//    }

}
