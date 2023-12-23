    @foreach ($details as $portfolio_text_for_album)
        @if (!($portfolio_text_for_album->getLocalizedTranslation() === 'not'))
            <div class="portfolio_text">
                {!!$portfolio_text_for_album->getLocalizedTranslation()!!}
            </div>
        @endif
    @endforeach
        <div class="main_container_for_slider">
            <div id="container_for_slider"></div>
            <div class="defense_copy"></div>
            <div class="button_scroll_div" id="button_scroll_div_left">

            </div>
            <div class="button_scroll_div" id="button_scroll_div_right">

            </div>
            <div class="button_scroll" id="scroll_left"></div>
            <div class="button_scroll" id="scroll_right"></div>
        </div>


