<div class="contacts_name_page">Portfolio</div>
    @foreach ($details as ['value'=>$portfolio_text_for_album])
        <div class="portfolio_text">
            {!!$portfolio_text_for_album!!}
        </div>
    @endforeach

