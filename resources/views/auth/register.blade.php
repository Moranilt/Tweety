<x-master>
    <div class="container mx-auto flex justify-center">
        <div class="bg-gray-200 px-12 py-8 rounded-lg border border-gray-300">

            <div class="font-bold text-lg mb-4">{{ __('Register') }}</div>


            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-6">
                    <label for="username"
                           class="uppercase font-bold col-md-4 col-form-label text-md-right">Username</label>


                    <input id="username" type="text" class="border border-gray-400 p-2 w-full"
                           name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="name"
                           class="uppercase font-bold col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>


                    <input id="name" type="text" class="border border-gray-400 p-2 w-full"
                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <div class="mb-6">
                    <label for="email"
                           class="uppercase font-bold col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>


                    <input id="email" type="email" class="border border-gray-400 p-2 w-full"
                           name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <div class="mb-6">
                    <label for="password" class="uppercase font-bold col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                               class="border border-gray-400 p-2 w-full" name="password" required
                               autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password-confirm"
                           class="uppercase font-bold col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="border border-gray-400 p-2 w-full" name="password_confirmation"
                               required autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="text-xl bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-2">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</x-master>
