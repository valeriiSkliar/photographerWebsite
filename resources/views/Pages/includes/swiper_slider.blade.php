<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
/>
<style>
    .swiper {
        width: 600px;
        height: 300px;
    }
</style>

<!-- Slider main container -->
<div class="swiper_{{$component->album->id}}">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach($component->album->images as $image)
        <div class="swiper-slide">
                <img src="{{ asset($image->file_url) }}" alt="">
        </div>
        @endforeach
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
{{--    <div class="swiper-button-prev"></div>--}}
{{--    <div class="swiper-button-next"></div>--}}

    <!-- If we need scrollbar -->
{{--    <div class="swiper-scrollbar"></div>--}}
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
        const mainSliderSwiper{{$component->album->id}} = new Swiper('.swiper_{{$component->album->id}}', {
        spaceBetween: 30,
        centeredSlides: true,
        effect: 'fade',
        slidesPerView: 1,
        speed: 800,
        direction: 'horizontal',
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        pagination: {
            type: 'bullets',
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            // nextEl: "swiper-button-next",
            // prevEl: "swiper-button-prev"
        },
    });
</script>