{{--@php--}}
{{--    // Create a mapping of page names to images--}}
{{--    $imageMap = collect($album->images)->keyBy('name');--}}
{{--@endphp--}}

<style>
    .grid_container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .grid_container a {
        position: relative;
    }
    .grid_container h2 {
        position: absolute;
        top: 50%;
        left: 50%;
        color: #FFFFFFCC;
        transform: translate(-50%, -50%);
        font-family: var(--font-lora);
        font-size: 40px;
        text-align: center;
        line-height: 50px;
    }
</style>

<section class="mt-14 w-full">
    <div class="grid grid-cols-3 grid-rows-2 gap-0">
{{--        @dd($imageMap)--}}
{{--        @foreach($all_pages as $page)--}}
{{--            @if($imageMap->has($page->name))--}}
{{--                <div class="{{ $page->name === 'Portfolio' ? 'grid_container row-span-2' : 'grid_container'}}">--}}
{{--                    <a class="relative" href="{{route('page.about')}}">--}}
{{--                        <img class="w-full object-cover" src="{{ $imageMap[$page->name]->file_url }}" alt="{{$name}}">--}}
{{--                        <h2 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">--}}
{{--                            {{$name}}--}}
{{--                        </h2>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endforeach--}}
        <div class="grid_container">
            <a class="relative" href="{{route('page.work')}}">
                <img class="w-full object-cover" src="{{asset('assets/page_thumbnail/Work.png')}}" alt="Work">
                <h2 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    Work
                </h2>
            </a>
        </div>
        <div class="grid_container">
            <a href="{{route('page.main')}}">
                <img src="{{asset('assets/page_thumbnail/Main.png')}}" alt="Main">
                <h2>
                    Main
                </h2>
            </a>
        </div>
        <div class="row-span-2 grid_container">
            <a href="{{route('page.portfolio')}}">
                <img src="{{asset('assets/page_thumbnail/Portfolio.png')}}" alt="Portfolio">
                <h2>
                    Portfolio
                </h2>
            </a>
        </div>
        <div class="grid_container">
            <a href="{{route('page.contact')}}">
                <img src="{{asset('assets/page_thumbnail/Contact.png')}}" alt="Contact">
                <h2>
                    Contact
                </h2>
            </a>
        </div>
        <div class="grid_container">
            <a href="{{route('page.about')}}">
                <img src="{{asset('assets/page_thumbnail/About.png')}}" alt="About">
                <h2>
                    About
                </h2>
            </a>
        </div>
    </div>
</section>
