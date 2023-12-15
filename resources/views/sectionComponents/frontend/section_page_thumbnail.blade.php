@php
    // Create a mapping of page names to images
    if (isset($album)) {
    $imageMap = collect($album->images)->keyBy('title');
    }
@endphp

<section class="mt-14 w-full">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-0">
        @foreach($pages as $page)
            @if($imageMap->has($page->name))
                <div class="{{ $page->name === 'Portfolio' ? 'grid_container row-span-2' : 'grid_container'}}">
                    <a class="relative" href="{{route(linkByLocale($current_locale, $page->slug))}}">
                        <img class="w-full h-full object-cover" src="{{ $imageMap[$page->name]->file_url }}"
                             alt="{{$imageMap[$page->name]->alt_text}}">
                        <h2 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-90 text-3xl text-center sm:text-3xl md:text-4xl lg:text-5xl xl:text-4xl">
                            {{$page->name}}
                        </h2>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</section>
