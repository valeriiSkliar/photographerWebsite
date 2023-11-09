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
                <h2 class="text-2xl font-bold text-[#002D74]">{{ __('reg&log.login') }}</h2>
                <p class="text-sm mt-4 text-[#002D74]">{{ __('reg&log.haveAccount') }}</p>
                <form class="mt-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-700">{{ __('reg&log.email') }}</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                            placeholder="{{ __('reg&log.emailPlaceholder') }}"
                        >
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-700" for="password">{{ __('reg&log.password') }}</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="{{ __('reg&log.passwordPlaceholder') }}"
                            minlength="6"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                             focus:bg-white focus:outline-none
                             @error('password') is-invalid @enderror"
                            required
                            autocomplete="current-password"
                        >
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('reg&log.loginRememberMe') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <a href="#" class="text-sm font-semibold text-gray-700 hover:text-blue-700 focus:text-blue-700">
                            {{ __('reg&log.forgotPassword') }}
                        </a>
                    </div>

                    <button type="submit" class="w-full block bg-blue-500 hover:bg-blue-400 focus:bg-blue-400 text-white font-semibold rounded-lg
                px-4 py-3 mt-6">
                        {{__('reg&log.btnLogIn')}}
                    </button>
                </form>

                <div class="mt-7 grid grid-cols-3 items-center text-gray-500">
                    <hr class="border-gray-500"/>
                    <p class="text-center text-sm">{{__('reg&log.or')}}</p>
                    <hr class="border-gray-500"/>
                </div>

{{--                <button--}}
{{--                    class="bg-white border py-2 w-full rounded-xl mt-5 flex justify-center items-center text-sm hover:scale-105 duration-300 ">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-6 h-6"--}}
{{--                         viewBox="0 0 48 48">--}}
{{--                        <defs>--}}
{{--                            <path id="a"--}}
{{--                                  d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/>--}}
{{--                        </defs>--}}
{{--                        <clipPath id="b">--}}
{{--                            <use xlink:href="#a" overflow="visible"/>--}}
{{--                        </clipPath>--}}
{{--                        <path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/>--}}
{{--                        <path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/>--}}
{{--                        <path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/>--}}
{{--                        <path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/>--}}
{{--                    </svg>--}}
{{--                    <span class="ml-4">Login with Google</span>--}}
{{--                </button>--}}

                <div class="text-sm flex justify-between items-center mt-3">
                    <p>{{ __('reg&log.existAccount') }}</p>
                    <a href="{{ route('register') }}"
                        class="py-2 px-5 ml-3 bg-white border rounded-xl hover:scale-110 duration-300 border-blue-400  ">
                        {{ __('reg&log.registration') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
