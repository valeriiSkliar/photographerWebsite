<nav class="navbar">
    <div class="container">
        <div class="navbar__links__list">
            <ul class="links__list">
                <li class="links__list__img">
                    <a href="{{ url('/') }}">
                        <img src="{{  asset($logo) }}" alt="site name" title="site name">
                    </a>
                </li>
                @foreach($routs as $name => $rout)
                    <li class="links__list__link">
                        <a href="{{  url($rout) }}">{{$name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="navbar__switcher">
            @foreach($available_locales as $locale_name => $available_locale)
                @if($available_locale === $current_locale)
                    <span class="navbar__switcher__currentLocale">{{ $locale_name }}</span>
                @else
                    <a class="navbar__switcher__availableLocale" href="language/{{ $available_locale }}">
                        <span>{{ $locale_name }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

</nav>
