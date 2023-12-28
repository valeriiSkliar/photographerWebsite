@php
    // Create a mapping of page names to images
    if (isset($album)) {
    $imageMap = collect($album->images)->keyBy('title');
    }
@endphp

<section class="mt-14 w-full">
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-0">
        @foreach($pages as $page)
            @if($imageMap->has($page->name))
                <div class="{{ $page->name === 'Portfolio' ? 'grid_container row-span-2' : 'grid_container'}}">
                    <a class="relative" href="{{route(linkByLocale($page->slug))}}">
                        <img class="w-full h-full object-cover" loading="lazy"
                             srcset="{{ $imageMap[$page->name]->file_url_small }} 900w, {{ $imageMap[$page->name]->file_url_medium }} 1024w"
                             src="{{ $imageMap[$page->name]->file_url_medium }}"
                             alt="">
                        <h2 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-90 text-2xl text-center sm:text-3xl md:text-4xl lg:text-5xl xl:text-4xl">
                            @if (app()->getLocale() === 'en')
                                {{$imageMap[$page->name]->title}}
                            @endif
                            @if (app()->getLocale() === 'de')
                                {{$imageMap[$page->name]->alt_text}}
                            @endif
                        </h2>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</section>
