@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .swiper-container {
            width: 80%;
            height: 80%;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .swiper-slide:hover {
            transform: scale(1.05);
            transition: transform 0.3s;
        }

    </style>
    @foreach($page->sections as $section)
        {{ $section->name }}


        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        @if($section->components)
            @foreach($section->components as $component)
                <h1>{{ $component->name }}</h1>
                @if($component->album)
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($component->album->images as $image)
                                <div class="swiper-slide" style="background-image: url({{ asset($image->file_url) }})">
                                    <img src="{{ asset($image->file_url) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{--                    @include('pages.includes.swiper_slider')--}}
                @endif
            @endforeach
        @endif
    @endforeach
    <script>
        const swiper = new Swiper('.swiper-container', {
            direction: 'horizontal',
            loop: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            spaceBetween: 10,
            grabCursor: true,

            on: {
                slideChange: function () {
                    const activeSlideEl = this.slides[this.activeIndex];
                    const backgroundImage = activeSlideEl.style.backgroundImage;
                    document.body.style.backgroundImage = backgroundImage;
                }
            }
        });

        // Set initial background image to body
        document.body.style.backgroundImage = swiper.slides[swiper.activeIndex].style.backgroundImage;

    </script>
@endsection
