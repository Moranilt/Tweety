<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $user_id;
    public $msgFrom;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $user_id, $msgFrom)
    {
        $this->message = $message;
        $this->user_id = $user_id;
        $this->msgFrom = $msgFrom;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.'.$this->user_id);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'username' => $this->msgFrom['user_username'],
            'name' => $this->msgFrom['user_name']
        ];
    }
}
