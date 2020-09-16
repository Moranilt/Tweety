<x-app>

    <div class="">
        <h1 class="font-bold text-lg mb-4 block">Followers {{ $count_followers }}</h1>

        @foreach($followers as $user)

            <a href="{{ $user->path() }}" class="flex items-center mb-5">

                <img src="{{ $user->avatar }}" alt="{{ $user->username }}'s avatar'" width="60" class="mr-4 rounded">


                <div class="">
                    <h4 class="font-bold">{{ '@' . $user->username}}</h4>
                </div>

            </a>


        @endforeach

        {{ $followers->links() }}

    </div>

</x-app>
