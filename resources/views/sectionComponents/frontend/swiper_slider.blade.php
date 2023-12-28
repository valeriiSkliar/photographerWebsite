@pushonce('custom-style')
    <link
        rel="stylesheet"
        href="{{ asset('swiper/swiper-bundle.min.css') }}"
    />
    @vite('resources/scss/swiper-thumbs.scss')
@endpushonce
<!-- Slider main container -->
<section class="main__slider relative">
    <div class="swiper-container gallery-top">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach($album->images as $image)
                <div class="swiper-slide">
                    <div class="imgGlass"></div>
                    {{--                    @dd($image)--}}
                        <img loading="lazy"
                             srcset="{{ $image->file_url_small }} 480w, {{ $image->file_url_medium }} 768w, {{ $image->file_url }} 1024w"
                             src="{{ $image->file_url_medium }}"
                             alt="{{$image->alt_text}}">
                    <div class="swiper-lazy-preloader"></div>
                </div>
            @endforeach
        </div>

        <!-- If we need pagination -->
        {{--            <div class="swiper-pagination"></div>--}}

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        {{--    <div class="swiper-scrollbar"></div>--}}
    </div>
</section>


@pushonce('custom-script')
    <script src="{{ asset('swiper/swiper-bundle.min.js') }}"></script>
@endpushonce

@push('custom-script')
    <script>
        const option = {
            loop: true,
            centeredSlides: true,
            // spaceBetween: 200,
            speed: 1000,
            keyboard: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
        };
        const galleryTop = new Swiper('.gallery-top', {
            ...option,
            effect: 'fade',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endpush
