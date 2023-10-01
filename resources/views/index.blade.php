<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>photographerWebsite</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
</head>
<body class="antialiased">
<div>
    {{--            @if (Route::has('login'))--}}
    {{--                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">--}}
    {{--                    @auth--}}
    {{--                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>--}}
    {{--                    @else--}}
    {{--                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>--}}

    {{--                        @if (Route::has('register'))--}}
    {{--                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
    {{--                        @endif--}}
    {{--                    @endauth--}}
    {{--                </div>--}}
    {{--            @endif--}}


    Тут находятся все views : <b class="text-amber-700">resources/views</b> в них можно писать разметку.
    <br>
    <b>resources/views/index.blade.php </b> Главная страница
    <pre>
        in php " ; " at the end of line is required!!!
        Пример как писать ссылки:
        a
            href="{{ "route('some_path')"}} {{ " именованый роут" }}">
        /a>
        a
            href="{{ "url('/dashboard')"}} {{ " относительная ссылка" }}">
        /a>
    </pre>

    <a href="{{ route('test') }}">TEST PAGE LINK</a>

</div>
</body>
</html>
