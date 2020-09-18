<div class="border border-gray-300 rounded-lg">
    @forelse($tweets as $tweet)
        @if($tweet->isSharedBy($user))

            <div class="flex p-6 border-b border-b-gray-400" style="flex-direction:column;">
                <div class="flex">
                    <div class="mr-2 flex-shrink-0">
                        @can('update-tweet', $tweet)<p>HELP</p>@endcan
                        <a href="{{ route('profile', $user->username) }}">
                            <img
                                src="{{ $user->avatar }}"
                                alt=""
                                class="rounded-full mr-2"
                                width="50"
                                height="50"
                            >
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('profile', $user->username) }}">
                            <h5 class="font-bold">{{ $user->name }}</h5>
                        </a>
                        <span class="text-xs text-gray-600">
                {{ $tweet->created_at->diffForHumans() }}
                </span>
                    </div>
                </div>


                <div class="w-full bg-blue-100 flex p-4 mt-4">

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
                         {{ $tweet->origin_created_at->diffForHumans() }}
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

            </div>
                @else

        @include('_tweet')
        @endif
    @empty
        <p class="p-4">No tweets yet</p>
    @endforelse

    {{ $tweets->links() }}
</div>
