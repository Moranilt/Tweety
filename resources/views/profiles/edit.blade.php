<x-app>

    <form action="{{ $user->path() }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                Name
            </label>

            <input
                type="text"
                name="name"
                id="name"
                class="border border-gray-400 p-2 w-full"
                value="{{ $user->name }}">

            @error('name')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="avatar" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                avatar
            </label>
            <div class="flex">

                <input
                    type="file"
                    name="avatar"
                    id="avatar"
                    class="border border-gray-400 p-2 w-full"
                    value="{{ $user->name }}">


                <img src="{{ $user->avatar }}" alt="your avatar" width="40" class="ml-4">
            </div>

            @error('avatar')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror

        </div>

        <div class="mb-6">
            <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                username
            </label>

            <input
                type="text"
                name="username"
                id="username"
                class="border border-gray-400 p-2 w-full"
                value="{{ $user->username }}">

            @error('username')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                description
            </label>

            <textarea
                name="description"
                id="description"
                class="border border-gray-400 p-2 w-full">{{ $user->description }}</textarea>

            @error('description')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                email
            </label>

            <input
                type="email"
                name="email"
                id="email"
                class="border border-gray-400 p-2 w-full"
                value="{{ $user->email }}">

            @error('email')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                password
            </label>

            <input
                type="password"
                name="password"
                id="password"
                class="border border-gray-400 p-2 w-full"
            >

            @error('password')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                password confirmation
            </label>

            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="border border-gray-400 p-2 w-full">

            @error('password_confirmation')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button
                type="submit"
                class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-4"
            >
                Submit
            </button>

            <a href="{{ $user->path() }}" class="hover:underline">Cancel</a>

        </div>

    </form>

</x-app>
