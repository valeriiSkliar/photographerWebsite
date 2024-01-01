<div class="main_container_for_slider">
    <div id="container_for_slider"></div>
    <div class="defense_copy" id="swiper_portfolio"></div>
    <div class="button_scroll" id="scroll_left"></div>
    <div class="button_scroll" id="scroll_right"></div>
</div>
    @foreach ($details as $portfolio_text_for_album)
        @if (!($portfolio_text_for_album->getLocalizedTranslation() === 'not'))
            <div class="portfolio_text">
                {!!$portfolio_text_for_album->getLocalizedTranslation()!!}
            </div>
        @endif
    @endforeach



