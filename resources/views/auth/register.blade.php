@extends('layouts.app')

@pushonce('custom-style')
    <style>
        .formLoginAndReg {
            height: calc(100vh - var(--navbar-height) - 150px);
        }
    </style>
@endpushonce

@section('content')
<section class="formLoginAndReg flex items-center justify-center text-black">
    <div class="bg-gray-100 p-5 flex rounded-2xl shadow-lg max-w-3xl">
        <div class="md:w-100 px-5">
            <h2 class="text-2xl font-bold text-[#002D74]">{{ __('reg&log.register') }}</h2>
            <form class="mt-6" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="sm:flex sm:gap-x-10">
                    <div class="flex flex-col justify-between">
                        <div>
                            <label for="name" class="block text-gray-700">{{ __('reg&log.name') }}</label>

                            <input id="name" type="text" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block text-gray-700">{{ __('reg&log.email') }}</label>

                            <input id="email" type="email" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col justify-between">
                        <div class="mt-4 sm:mt-0">
                            <label class="block text-gray-700" for="password">{{ __('reg&log.password') }}</label>

                            <input id="password" type="password" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                             focus:bg-white focus:outline-none
                             @error('password') is-invalid @enderror" name="password" required  minlength="6" autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700"
                                   for="password-confirm">{{ __('reg&log.confirmPassword') }}</label>

                            <input id="password-confirm" type="password" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                             focus:bg-white focus:outline-none
                             @error('password') is-invalid @enderror" name="password_confirmation" required minlength="6" autocomplete="new-password">

                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full block bg-blue-500 hover:bg-blue-400 focus:bg-blue-400 text-white font-semibold rounded-lg
                px-4 py-3 mt-6">
                    {{__('reg&log.register')}}
                </button>
            </form>

            <div class="mt-7 grid grid-cols-3 items-center text-gray-500">
                <hr class="border-gray-500"/>
                <p class="text-center text-sm">{{__('reg&log.or')}}</p>
                <hr class="border-gray-500"/>
            </div>

            <div class="text-sm flex justify-between sm:justify-center items-center mt-3">
                <p>{{ __('reg&log.inRegHaveAccount') }}</p>
                <a href="{{ route('login') }}"
                   class="py-2 px-5 ml-3 bg-white border rounded-xl hover:scale-110 duration-300 border-blue-400  ">
                    {{ __('reg&log.regBtnLogin') }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
