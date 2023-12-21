{{-- <section class="thoughts relative mt-14">
    <img class="w-full h-full object-cover" src="{{ asset($album->images[0]->file_url) }}" alt="Photo">
    <h1 class="credo">
        {{$details[0]->getLocalizedTranslation()}}
    </h1>
    <div class="thoughts__text">
        @foreach($details as $text)
            @continue($loop->first)
            <p>
                {{$text->getLocalizedTranslation()}}
            </p>
        @endforeach
    </div>
</section> --}}
<div class="about_section">
    <img class="w-full h-full object-cover" src="{{ asset($album->images[0]->file_url) }}" alt="Photo">
    <div class="about_title title_2">
        {{$details[0]->getLocalizedTranslation()}}
    </div>
    <div class="about_text text_2">
        @foreach($details as $text)
            @continue($loop->first)
            <p>
                {{$text->getLocalizedTranslation()}}
            </p>
        @endforeach
    </div>
    <div class="defense_copy"></div>
</div>

