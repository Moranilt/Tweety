<x-master>
<div class="container mx-auto flex justify-center">
    <div class="bg-gray-200 px-12 py-8 rounded-lg border border-gray-300">

        <div class="font-bold text-lg mb-4">{{ __('Login') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">

                    <label for="email" class="uppercase font-bold col-md-4 col-form-label text-md-right" >
                        Email
                    </label>

                    <input class="border border-gray-400 p-2 w-full" type="text" name="email" autocomplete="email" id="email"
                           value="{{ old('email') }}">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="mb-6">

                    <label for="password" class="font-bold uppercase col-md-4 col-form-label text-md-right">
                        password
                    </label>

                    <input class="border border-gray-400 p-2 w-full" type="password" name="password" id="password"
                           value="{{ old('password') }}" autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="mb-6">

                    <input class="mr-1" type="checkbox" name="remember" id="remember">

                    <label for="remember" class="font-bold col-md-4 col-form-label text-md-right uppercase"
                        {{ old('remember') ? 'checked' : '' }}>
                        Remember Me
                    </label>

                </div>


                <div class="mb-6">

                    <button class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-2" type="submit">
                        Submit
                    </button>

                    <a href="{{ route('password.request') }}" class="text-xs text-gray-700 ">
                        Forgot Your Password?
                    </a>

                </div>

            </form>
        </div>

    </div>
</div>
</x-master>
