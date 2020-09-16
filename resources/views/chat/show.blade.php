<x-app>
    <div id="chat-frame">
    <div id="chat" class="mb-4" style="height:60vh;overflow-y: auto;">
        @isset($messages)


        @foreach($messages as $message)
            @if($message->user_id == current_user()->id)
                <div class="py-4 px-6 bg-white text-right flex justify-between">


                    <div class="text-xs">
                        {{ $message->created_at->diffForHumans() }}
                    </div>
                    <div>
                        {{ Crypt::decryptString($message->message) }}
                    </div>
                </div>
            @else
                <div class="py-4 px-6 bg-blue-100 flex justify-between">
                    <div>
                        <p>
                            <a class="font-bold text-xs text-blue-700" href="{{ route('profile', $message->user->username) }}">
                                {{ $message->user->username }}
                            </a>
                        </p>
                        {{ Crypt::decryptString($message->message)}}
                    </div>

                    <div class="text-xs">
                        {{ $message->created_at->diffForHumans() }}
                    </div>
                </div>
            @endif

        @endforeach
        @endisset

    </div>
</div>
    <form id="send_chat_form" action="{{route('chats.send', $chat_id)}}" method="post" >
        @csrf
        <textarea autofocus id="message_input" name="message" class="border-2 border-blue-300 w-full px-2 mb-4" rows="4" style="resize:none;"></textarea>
        <input id="chat_id" type="hidden" name="chat_id" value="{{$chat_id}}">
        <button id="send-msg" type="submit" class="rounded-full px-6 py-2 bg-blue-500 text-white">Send</button>
    </form>

<script>
    $('#chat').scrollTop($('#chat')[0].scrollHeight);
</script>
</x-app>
