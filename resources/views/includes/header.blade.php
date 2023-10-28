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
