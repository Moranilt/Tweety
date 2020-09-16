<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Conversation;
use App\Events\MessageSent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ChatsController extends Controller
{
    public function index()
    {

        $chats = current_user()->chats;
//        foreach($chats as $chat){
//            $chats_users = $chat->user->pluck('username');
//        }
//                $current_user_id = $chats_users->search(current_user()->username);
//                $chats_users->except($current_user_id);
//
//
//
//        ddd($chats, $chats_users);
        return view('chat.index', [
            'chats' => $chats
        ]);
    }

    public function show(Chat $chat)
    {
        $messages = $chat->conversation;
        return view('chat.show', [
            'messages' => $messages,
            'chat_id' => $chat->id
        ]);
    }

    public function create(User $user)
    {
        $chats_current_user = auth()->user()->chats()->pluck('chat_id');
        if($user->chats()->whereIn('chat_id', $chats_current_user)->exists()){
            $chat = $user->chats()->whereIn('chat_id', $chats_current_user)->get();

            //$chat->first()->pivot->user_id

            return redirect()->route('chats.show', $chat->first()->id);
        }else{
            $chat = new Chat();
            $chat->name = auth()->user()->name.'-'.$user->name;
            $chat->save();
            $chat->user()->attach([$user->id, current_user()->id]);

           // return view('chat.show', [
           //     'chat_with_id' => $user->id
           // ]);

            return redirect()->route('chats.show', $chat->id);
        }

    }

    public function store(Chat $chat)
    {

            $chatTo = $chat->user()->get()->except(current_user()->id)->first()->pivot->user_id;
        $message = new Conversation();
        $message->message = Crypt::encryptString(request('message'));
        $message->chat_id = $chat->id;
        $message->user_id = current_user()->id;
        $message->save();
        $msgFrom = [
            'user_username' => current_user()->username,
            'user_name' => current_user()->name
        ];

        event(new MessageSent($message, $chatTo, $msgFrom));
        return response()->json(['message' => request('message'), 'created_at' => $message->created_at]);
//
//        return back();

    }
}
