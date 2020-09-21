




<div class="tweet relative flex p-4 {{$loop->last ? '' : 'border-b border-b-gray-400'}} " data-tweet-id="{{ $tweet->id }}">

    @can('update-tweet', $tweet)
        <div class="absolute tweet-menu" style="right:30px;">
            <div class="menu-dots text-gray-500 hover:text-gray-700 text-center"
                 style="cursor:pointer;display:block;width:50px; line-height:50px; font-size:18px;">
                <i class="fas fa-ellipsis-h"></i>
            </div>

            <div class="sub-menu bg-white text-sm shadow-lg border border-gray-100"
                 style="width:150px; right:0; display:none; position:absolute;">
                <ul>
                    <li class="tweet-edit border-b border-gray-200 px-4 py-1 cursor-pointer hover:bg-gray-100"
                        data-tweet-id="{{$tweet->id}}">Edit
                    </li>
                    <li class="tweet-delete px-4 py-1 cursor-pointer hover:bg-gray-100" data-tweet-id="{{$tweet->id}}">Delete</li>
                </ul>
            </div>
        </div>

    @endcan

    <div class="mr-2 flex-shrink-0">
        <a href="{{ route('profile', $tweet->user) }}">
            <img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="50"
                height="50"
            >
        </a>
    </div>

    <div class="tweet-content" style="width:100%">

        <a href="{{ route('profile', $tweet->user) }}">
            <h5 class="font-bold">{{ $tweet->user->name }}</h5>
        </a>
        <span class="text-xs text-gray-600">
            {{ $tweet->created_at->diffForHumans() }}
        </span>

        <div class="tweet-body">
{{--            <p class="tweet-photo">--}}
{{--                @isset($tweet->photo)--}}
{{--                    <img src="{{ asset('storage/'.$tweet->photo) }}" alt="your photo">--}}
{{--                @endisset--}}
{{--            </p>--}}

            <div class="text-sm mb-3 mt-4" style="width:100%;">
                {!! $tweet->body !!}
            </div>
        </div>

        <div class="flex">
            <x-like-buttons :tweet="$tweet">

            </x-like-buttons>

            <x-share :tweet="$tweet">

            </x-share>
        </div>

    </div>

</div>


