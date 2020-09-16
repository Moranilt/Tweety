<x-app>
    @foreach($chats as $chat)
        <a href="{{ route('chats.show', $chat->id ) }}">
        <div class="px-4 py-6 border-2 border-blue-200 my-4 w-full">
            <h2 class="font-bold text-blue-600 mb-2">{{ $chat->user()->get()->except(auth()->user()->id)->first()->username }}</h2>
            <div class="mb-2">


                @if($chat->conversation->count() > 0)
                    {{ Crypt::decryptString($chat->conversation->last()->message) }}
                @else
                    There are no messages here...
                @endif



            </div>
            <div class="text-xs">

                @if($chat->conversation->count() > 0)
                    {{ $chat->conversation->last()->created_at->diffForHumans() }}
                @endif

            </div>
        </div>
        </a>
    @endforeach
</x-app>
