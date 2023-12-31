@pushonce('custom-style')
    <link
        rel="stylesheet"
        href="{{ asset('swiper/swiper-bundle.min.css') }}"
    />
    @vite('resources/scss/swiper-thumbs.scss')
@endpushonce
<!-- Slider main container -->
<section class="main__slider relative">
    <h1 class="watter__mark absolute opacity-50 z-10" tabindex="-1">Olena Yavorska</h1>
    <div class="swiper-container gallery-top">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach($album->images as $image)
                <div class="swiper-slide">
                    <div class="imgGlass"></div>
                    <img loading="lazy" src="{{ $image->file_url }}" alt="">
                    <div class="swiper-lazy-preloader"></div>
                </div>
            @endforeach
        </div>

        <!-- If we need pagination -->
        {{--    <div class="swiper-pagination"></div>--}}

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        {{--    <div class="swiper-scrollbar"></div>--}}
    </div>

    <div class="swiper gallery-thumbs">
        <div class="swiper-wrapper">
            @foreach($album->images as $image)
                <div class="swiper-slide">
                    <img src="{{ $image->file_url }}" alt="">
                </div>
            @endforeach
        </div>
    </div>
</section>


@pushonce('custom-script')
    <script src="{{ asset('swiper/swiper-bundle.min.js') }}"></script>
@endpushonce

@push('custom-script')
    <script >
        const slidesPerView = 3;
        const option = {
            loop: true,
            centeredSlides: true,
            slidesPerView: slidesPerView,
            spaceBetween: 200,
            speed: 500,
            keyboard: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        };
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            ...option,
            on: {
                'tap': function () {
                    const slide = this.clickedSlide.classList[1];
                    if (slide === 'swiper-slide-prev') {
                        galleryTop.slidePrev();
                    }
                    if (slide === 'swiper-slide-next') {
                        galleryTop.slideNext();
                    }
                }
            }
        });

        var galleryTop = new Swiper('.gallery-top', {
            ...option,
            effect: 'fade',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                'navigationNext': function () {
                    galleryThumbs.slideNext();
                },
                'navigationPrev' : function () {
                    galleryThumbs.slidePrev();
                },
                'touchStart': function (){
                    this.autoplay.stop();
                    galleryThumbs.autoplay.stop();
                },
                'touchEnd': function () {
                    this.autoplay.start();
                    galleryThumbs.autoplay.start();
                },
                'slidePrevTransitionStart': function () {
                    galleryThumbs.slidePrev();
                },
                'slideNextTransitionStart': function () {
                    galleryThumbs.slideNext();
                }
            },
        });
    </script>
@endpush
