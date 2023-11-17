<header>
    <nav class="navbar px-5 md:justify-evenly">
        <div class="hidden md:flex navbar__switcher items-center text-xs">
            @foreach($available_locales as $locale_name => $available_locale)
                <div class="px-2 first:border-r-2 border-gray-200">
                    @if($available_locale === $current_locale)
                        <span
                            class="navbar__switcher__currentLocale active__link select-none">{{ __( 'lang-switcher.'.$locale_name) }}
                        </span>
                    @else
                        <a class="block navbar__switcher__availableLocale" href="language/{{ $available_locale }}">
                            <span>{{ __( 'lang-switcher.'.$locale_name) }}</span>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="navbar__links__list gap-5 md:gap-0 items-center w-full md:w-auto md:justify-evenly flex">
            <!-- Hamburger -->
            <!-- Mobile Menu Toggle -->
            <button class="flex justify-center md:hidden flex-col items-center" @click="openMenu = !openMenu"
                    :aria-expanded="openMenu" aria-controls="mobile-navigation" aria-label="Navigation Menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div class=" md:hidden navbar__switcher flex flex-col items-center text-xs">
                @foreach($available_locales as $locale_name => $available_locale)
                    <div class="first:border-b-2 border-gray-200">
                        @if($available_locale === $current_locale)
                            <span
                                class="
                                        {{ $loop->iteration === 1 ? 'mb-1' : 'mt-1' }}
                                        block
                                        navbar__switcher__currentLocale
                                        active__link select-none
                                        "
                            >
                                    {{ __( 'lang-switcher.'.$locale_name) }}
                            </span>
                        @else
                            <a class="
                                    {{ $loop->iteration === 1 ? 'mb-1' : 'mt-1' }}
                                    block
                                    navbar__switcher__availableLocale
                                    "
                               href="language/{{ $available_locale }}">
                                <span>{{ __( 'lang-switcher.'.$locale_name) }}</span>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>

            <ul class="hidden md:flex align-items-center gap-5">
                @foreach($pages as ['name'=>$name, 'slug'=>$slug])
                    @continue($name === 'Main')
                    <li class="links__list__link">
                        <a href="{{  route('page.'.$slug) }}">{{__('nav-bar.links.'.$name)}}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex align-items-center nav-logo">
            <a href="{{ route('index.page') }}">
                <h1>Olena Yavorska</h1>
            </a>
        </div>
    </nav>

</header>

{{--<!-- Pop Out Navigation -->--}}
<nav id="mobile-navigation" class="fixed top-0 right-0 bottom-0 left-0 backdrop-blur-sm z-20 text-black"
     :class="openMenu ? 'visible' : 'invisible' " x-cloak>

    <!-- UL Links -->
    <ul class="absolute top-0 right-0 bottom-0 w-full py-4 bg-white drop-shadow-2xl z-20 transition-all"
        :class="openMenu ? 'translate-x-0' : 'translate-x-full'">

        @foreach($pages as ['name'=>$name, 'slug'=>$slug])
            <li class="border-b border-inherit text-center">
                <a class="block p-4" href="{{  route('page.'.$slug) }}">{{__('nav-bar.links.'.$name)}}</a>
            </li>
        @endforeach

        {{--        <li class="navbar__switcher p-4 flex justify-center gap-x-12 border-b border-inherit">--}}
        {{--            @foreach($available_locales as $locale_name => $available_locale)--}}
        {{--                <div class="first:border-r-gray-200">--}}
        {{--                @if($available_locale === $current_locale)--}}
        {{--                    <span--}}
        {{--                        class="navbar__switcher__currentLocale active__link">{{ __( 'lang-switcher.'.$locale_name) }}</span>--}}
        {{--                @else--}}
        {{--                    <a class="block navbar__switcher__availableLocale" href="language/{{ $available_locale }}">--}}
        {{--                        <span>{{ __( 'lang-switcher.'.$locale_name) }}</span>--}}
        {{--                    </a>--}}
        {{--                @endif--}}
        {{--                </div>--}}
        {{--            @endforeach--}}
        {{--        </li>--}}
        <li class=" border-inherit flex justify-center p-10">
            <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
               href="{{route('index.dashboard')}}">
                Admin panel
            </a>
        </li>
    </ul>

    <!-- Close Button -->
    <button class="absolute top-2 left-5 z-30 w-10" @click="openMenu = !openMenu" :aria-expanded="openMenu"
            aria-controls="mobile-navigation" aria-label="Close Navigation Menu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

</nav>
