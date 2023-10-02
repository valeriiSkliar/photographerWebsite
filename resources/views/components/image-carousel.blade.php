@props(['images' => []])


{{-- @push('carousel-style') --}}
    @vite(['resources/css/carousel.css'])
{{-- @endpush --}}

<section class="introSlider">
	<div class="contentSlider">
    @foreach ($images as $key => $image)
    <div class="slide" id="{{'introSlider_slide'.$loop->index}}" style="{{'background-image: url('.$image.');'}}">
      @if ($loop->index == 0)
      <a class="btnSliderArrow introSlider_prev" href="{{'#introSlider_slide'.($loop->count - 1)}}">
        Goto last slide
      </a>
      @else
      <a class="btnSliderArrow introSlider_prev" href="{{'#introSlider_slide'.($loop->index - 1)}}">
        Goto last slide
      </a>
      @endif
    <div class="introTxt">
      <div class="mainText">
        <h4 class="font-sizeScale_f25">
          Unique and Modern Design
        </h4>
        <h2 class="font-sizeScale_f34">
          Portfolio PSD Template
        </h2>
        <p class="font-sizeScale_14">
          Nam liber tempor cum siluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.
        </p>
        <a class="btnStarter" href="#">
          GET STARTED
        </a>
      </div>
    </div>
    @if ($loop->count > $loop->index + 1)
    <a class="btnSliderArrow introSlider_next" href="{{'#introSlider_slide'.($loop->index + 1)}}">
      Goto next slide
    </a>
    @else
    <a class="btnSliderArrow introSlider_next" href="#introSlider_slide0">
      Goto next slide
    </a>
    @endif
  </div>
    @endforeach
	</div>
	<div class="introSliderSvg leftSvg">
		<svg>
			<use xlink:href="/assets/svg/sprite.svg#hero-arrow-left"></use>
		</svg>
	</div>
	<div class="introSliderSvg rightSvg">
		<svg>
			<use xlink:href="/assets/svg/sprite.svg#hero-arrow-right"></use>
		</svg>
	</div>
	<div class="linksToEachPage">
    @foreach ($images as $key)
		<a class="pointOfLink" href="{{'#introSlider_slide'.$loop->index}}"></a>
    @endforeach
	</div>
</section>
