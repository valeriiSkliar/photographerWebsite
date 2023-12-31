@pushonce('custom-script')
@vite('resources/js/langSwitcher.js')
@endpushonce
<header>
    <nav class="navbar px-5 md:justify-evenly stroke">
        <div class="hidden md:flex navbar__switcher items-center text-xs">
            @foreach($available_locales as $locale_name => $available_locale)
                <div class="px-2 first:border-r-2 border-gray-200">
                    @if($available_locale === app()->getLocale())
                        <span
                            class="navbar__switcher__currentLocale active__link select-none">{{ __( 'lang-switcher.'.$locale_name) }}</span>
                    @else
                        <a
                            class="block navbar__switcher__availableLocale"
                            href="{{($available_locale === config('app.defaultLocale')) ? '/' : '/' . $available_locale}}"
                            data-lang="{{$available_locale}}"
                        >
                            <span>{{ __( 'lang-switcher.'.$locale_name) }}</span>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>


        <div class="navbar__links__list gap-x-7 md:gap-0 items-center w-full md:w-auto md:justify-evenly flex">
            <!-- Mobile Hamburger Button -->
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
                        @if($available_locale === app()->getLocale())
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
                            <a class="{{ $loop->iteration === 1 ? 'mb-1' : 'mt-1' }} block navbar__switcher__availableLocale" data-lang="{{$available_locale}}"
                               href="{{ ($available_locale === config('app.defaultLocale')) ? '/' : '/' . $available_locale }}"
                            >
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
                        <a href="{{  route(linkByLocale($slug)) }}">
                            {{__('nav-bar.links.'.$name)}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex align-items-center nav-logo">
            <a href="{{ route(linkByLocale()) }}">
                <h1>Olena Yavorska</h1>
            </a>
        </div>
    </nav>

</header>

{{--<!-- Mobile Pop Out Navigation -->--}}
<nav id="mobile-navigation" class="fixed top-0 right-0 bottom-0 left-0 backdrop-blur-sm z-20 text-black transition-all"
     :class="openMenu ? 'visible' : 'invisible' " x-cloak>

    <!-- UL Links -->
    <div class="burgerMenuList absolute flex flex-col justify-between left-0 drop-shadow-2xl z-20 transition-all"
         :class="openMenu ? 'translate-x-0' : '-translate-x-80'">
        <ul>

            @foreach($pages as ['name'=>$name, 'slug'=>$slug])
                <li class="text-center text-white burgerMenuItem">
                    @if($slug === 'main')
                        <a class="block p-4" href="{{  route(linkByLocale()) }}">
                            {{__('nav-bar.links.'.$name)}}
                        </a>
                    @else
                        <a class="block p-4" href="{{  route(linkByLocale($slug)) }}">
                            {{__('nav-bar.links.'.$name)}}
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
        <div class="logoPhotographer px-7 pb-20 user-select-none">
            <a href="{{ route(linkByLocale()) }}">
            <h3 class="text-start">Olena</h3>
            <h3 class="text-end">Yavorska</h3>
            </a>
        </div>
    </div>

    <!-- Close Button -->
    <button class="absolute top-0 right-0 bottom-0 left-0" @click="openMenu = !openMenu" :aria-expanded="openMenu"
            aria-controls="mobile-navigation" aria-label="Close Navigation Menu"></button>

</nav>
<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "item": {
                    "@id": "{{ route(linkByLocale()) }}",
                    "name": "{{config('app.name')}}"
                }
            } @if(isset($page) && $page->slug !== 'main'),
            {
                "@type": "ListItem",
                "position": 2,
                "item": {
                    "@id": "{{ route(linkByLocale($page->slug)) }}",
                    "name": "{{__('nav-bar.links.'.$page->name)}}"
                }
            }
            @endif
        ]
    }
</script>
