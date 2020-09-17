<ul>
    <li>
        <a
            class="font-bold text-lg mb-4 block"
            href="{{ route('home') }}"
        >
            Home
        </a>
    </li>

    <li>
        <a
            class="font-bold text-lg mb-4 block"
            href="/tweets"
        >
            Tweets
        </a>
    </li>

    <li>
        <a
            class="font-bold text-lg mb-4 block"
            href="{{route('chats.all')}}"
        >
            Chats
        </a>
    </li>

    <li>
        <a
            class="font-bold text-lg mb-4 block"
            href="/explore"
        >
            Explore
        </a>
    </li>

    <li>
        <a
            class="font-bold text-lg mb-4 block"
            href="{{ route('followers.show', auth()->user()->username) }}"
        >
            Followers
        </a>
    </li>

{{--    <li class="relative">--}}
{{--        <a--}}
{{--            class="font-bold text-lg mb-4 block"--}}
{{--            href="/notifications"--}}
{{--            id="notify_link"--}}
{{--        >--}}
{{--            Notifications <span class="absolute content-center items-center text-center" style="top:4px; right:-10px;background-color:#ea3355;  width:20px; height:20px; font-size:12px; color:white; border-radius:100%;" >{{ auth()->user()->unreadNotifications->count() }}</span>--}}
{{--        </a>--}}
{{--    </li>--}}

    <li>
        <a
            class="font-bold text-lg mb-4 block"
            href="{{ route('profile', auth()->user() ) }}"
        >
            Profile
        </a>
    </li>

    <li>

        <form method="POST" action="/logout">
            @csrf

            <button class="font-bold text-lg">Logout</button>
        </form>

    </li>

</ul>
