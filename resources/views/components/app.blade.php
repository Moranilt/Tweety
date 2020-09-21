<x-master>
    <section class="px-8 py-4 mb-6 border-b-2 border-gray-600">
        <header class="container mx-auto flex justify-between">
            <h1>
                <img src="/images/logo.svg" alt="tweety">
            </h1>
            <div style="font-size:18px; cursor:pointer; position:relative;">
                <i id="notify-bell" class="fas fa-bell" style="position:relative;">
                    <div id="count-notifications"
                         style=" @if(auth()->user()->unreadNotifications->count() == 0)display:none;@endif padding:3px;font-size:12px; color:#fafafa; position:absolute; top:-10px; right:-10px; background-color: #fa4433; border-radius:100%;">

                        {{ auth()->user()->unreadNotifications->count() }}


                    </div>
                </i>

                <div id="notify-content" style="display:none;border:1px solid #ddd;background-color:#fafafa; box-shadow: 3px 3px 7px 2px rgba(50,50,50, 0.2);position:absolute; top:100%; right:-20px; width:350px; overflow-y:auto; max-height:400px; z-index:100;">
                    <div id="notify-refresh">
                    @foreach(auth()->user()->unreadNotifications->take(15) as $notification)
                        @if($notification->type == 'App\Notifications\TweetLiked' )
                            <p class="bg-red-100 py-2 px-2 border-b border-gray-500 text-xs hover:bg-gray-200">
                                <a class="text-blue-400 font-bold"
                                   href="{{ route('profile', $notification->data['username']) }}">{{ $notification->data['user'] }}</a>
                                liked your tweet <a
                                    href="/tweets/{{ $notification->data['tweet_id'] }}">{{ $notification->data['tweet_excerpt'] }}</a> {{ $notification->created_at->diffForHumans() }}
                            </p>
                        @elseif($notification->type == 'App\Notifications\FollowingUsers')
                        <p class="bg-red-100 py-2 px-2 border-b border-gray-500 text-xs hover:bg-gray-200">
                            <a class="text-blue-400 font-bold"
                               href="{{ route('profile', $notification->data['username']) }}">{{ $notification->data['user'] }}</a>
                            {{ $notification->data['message'] }} {{ $notification->created_at->diffForHumans() }}
                        </p>
                        @endif
                    @endforeach

                    @foreach(auth()->user()->readNotifications->take(15) as $notification)
                        @if($notification->type == 'App\Notifications\TweetLiked' )
                            <p class="py-2 px-2 border-b border-gray-500 text-xs hover:bg-gray-200">
                                <a class="text-blue-400 font-bold"
                                   href="{{ route('profile', $notification->data['username']) }}">{{ $notification->data['user'] }}</a>
                                liked your tweet <a
                                    href="/tweets/{{ $notification->data['tweet_id'] }}">{{ $notification->data['tweet_excerpt'] }}</a> {{ $notification->created_at->diffForHumans() }}
                            </p>
                        @elseif($notification->type == 'App\Notifications\FollowingUsers')
                        <p class="py-2 px-2 border-b border-gray-500 text-xs hover:bg-gray-200">
                            <a class="text-blue-400 font-bold"
                               href="{{ route('profile', $notification->data['username']) }}">{{ $notification->data['user'] }}</a>
                            {{ $notification->data['message'] }} {{ $notification->created_at->diffForHumans() }}
                        </p>
                        @endif
                    @endforeach
                </div>
                </div>

            </div>
        </header>
    </section>

  <section class="px-8">

  <main class="container mx-auto">

    @section('content')
      <div class="lg:flex lg:justify-between">
        <div class="lg:w-32">
          @include('_sidebar-links')
        </div>

        <div id="main-tweets" class="lg:flex-1 lg:mx-10 " style="max-width:700px;">

          {{ $slot }}

        </div>

        <div class="lg:w-1/6">
          @include('_friends-list')
        </div>
      </div>
  </main>
  </section>

</x-master>
