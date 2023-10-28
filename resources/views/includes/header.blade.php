<header>
{{--    @dd($available_locales)--}}
    <nav class="navbar">
        <div class="container">
            <div class="navbar__links__list">
                <ul class="links__list">
                    <li class="links__list__img">
                        <a href="{{ route('index.page') }}">
                            <img src="{{  asset('assets/logo/logo_nav.svg') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}">
                        </a>
                    </li>
                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    @foreach($all_pages as ['name'=>$name, 'slug'=>$slug])
                        @continue($name === 'Main')
                        <li class="links__list__link">
                            <a href="{{  route('page.'.$slug) }}">{{__('nav-bar.links.'.$name)}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="navbar__switcher flex gap-x-2">
                @foreach($available_locales as $locale_name => $available_locale)
                    @if($available_locale === $current_locale)
                        <span class="navbar__switcher__currentLocale active__link">{{ __( 'lang-switcher.'.$locale_name) }}</span>
                    @else
                        <a class="navbar__switcher__availableLocale" href="language/{{ $available_locale }}">
                            <span>{{ __( 'lang-switcher.'.$locale_name) }}</span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

    </nav>

</header>
