<header>
    <nav class="navbar px-5 md:justify-evenly">
            <div class="navbar__links__list justify-between items-center w-full md:w-auto md:justify-evenly flex gap-5">
                <div class="flex align-items-center">
                    <a href="{{ route('index.page') }}">
                        <img src="{{  asset('assets/logo/logo_nav.svg') }}" alt="{{ config('app.name') }}"
                             title="{{ config('app.name') }}">
                    </a>
                </div>
                <!-- Hamburger -->
                <!-- Mobile Menu Toggle -->
                <button class="flex justify-center md:hidden flex-col items-center" @click="openMenu = !openMenu"
                        :aria-expanded="openMenu" aria-controls="mobile-navigation" aria-label="Navigation Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span class="text-xs">Menu</span>
                </button>
                <ul class="hidden md:flex align-items-center gap-5">
                    @foreach($pages as ['name'=>$name, 'slug'=>$slug])
                        @continue($name === 'Main')
                        <li class="links__list__link">
                            <a href="{{  route('page.'.$slug) }}">{{__('nav-bar.links.'.$name)}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="hidden md:flex navbar__switcher items-center gap-x-2">
                @foreach($available_locales as $locale_name => $available_locale)
                    @if($available_locale === $current_locale)
                        <span
                            class="navbar__switcher__currentLocale active__link">{{ __( 'lang-switcher.'.$locale_name) }}</span>
                    @else
                        <a class="navbar__switcher__availableLocale" href="language/{{ $available_locale }}">
                            <span>{{ __( 'lang-switcher.'.$locale_name) }}</span>
                        </a>
                    @endif
                @endforeach
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

        <li class="navbar__switcher p-4 flex justify-center gap-x-12 border-b border-inherit">
            @foreach($available_locales as $locale_name => $available_locale)
                @if($available_locale === $current_locale)
                    <span class="navbar__switcher__currentLocale active__link">{{ __( 'lang-switcher.'.$locale_name) }}</span>
                @else
                    <a class="navbar__switcher__availableLocale" href="language/{{ $available_locale }}">
                        <span>{{ __( 'lang-switcher.'.$locale_name) }}</span>
                    </a>
                @endif
            @endforeach
        </li>
        <li class=" border-inherit flex justify-center p-10">
            <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" href="{{route('index.dashboard')}}">
                Admin panel
            </a>
        </li>
    </ul>

    <!-- Close Button -->
    <button class="absolute top-2 right-5 z-30 w-10" @click="openMenu = !openMenu" :aria-expanded="openMenu"
            aria-controls="mobile-navigation" aria-label="Close Navigation Menu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

</nav>
