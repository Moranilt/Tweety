<x-app>

  <header class="mb-6 relative">
    <div class="relative">
      <img
      src="/images/default-profile-banner.jpg"
      alt=""
      class="mb-2"
      >

      <img
          src="{{ asset($user->avatar) }}"
          alt="your avatar"
          class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
          style="left:50%"
          width="150"
      >
    </div>

    <div class="flex justify-between  items-center mb-6">
      <div class="" style="max-width:270px">
          <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
          <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
      </div>

      <div class="flex">
        @can('edit', $user)
        <a
          href="{{ $user->path('edit') }}"
          class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2"
        >
          Edit Profile
        </a>
        @endcan

        <x-follow-button :user="$user">



      </x-follow-button>
            @if(current_user()->isNot($user))
                <form action="{{ route('chats.create', $user->username) }}" method="post" class="my-0">
                    @csrf
                    <button
                        type="submit"
                        class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs"
                        style="outline:none;"
                    >
                        Message
                    </button>
                </form>
            @endif

      </div>

    </div>

    <p class="text-sm">
        @empty($user->description)
            No description
        @else
            {{ $user->description }}
        @endempty
    </p>




  </header>

  @include('_timeline_profile', [
    'tweets' => $tweets
  ])


</x-app>
