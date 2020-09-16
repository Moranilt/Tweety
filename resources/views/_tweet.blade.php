




<div class="flex p-4 {{$loop->last ? '' : 'border-b border-b-gray-400'}} ">

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

    <div class="">
        <a href="{{ route('profile', $tweet->user) }}">
            <h5 class="font-bold">{{ $tweet->user->name }}</h5>
        </a>
        <span class="text-xs text-gray-600">
            {{ $tweet->created_at->diffForHumans() }}
        </span>

        <p>
            @isset($tweet->photo)
                <img src="{{ asset('storage/'.$tweet->photo) }}" alt="your photo">
            @endisset
        </p>

        <p class="text-sm mb-3 mt-4">
            {{ $tweet->body }}
        </p>

        <div class="flex">
            <x-like-buttons :tweet="$tweet">

            </x-like-buttons>

            <x-share :tweet="$tweet">

            </x-share>
        </div>

    </div>

</div>


