    @foreach ($details as ['value'=>$portfolio_text_for_album])
        <div class="portfolio_text">
            {!!$portfolio_text_for_album!!}
        </div>
    @endforeach
        <div class="main_container_for_slider">
            <div id="container_for_slider"></div>
            <div class="defense_copy"></div>
            <div class="button_scroll" id="scroll_left"></div>
            <div class="button_scroll" id="scroll_right"></div>
        </div>


