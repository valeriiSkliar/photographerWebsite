<div class="about_section">
    <img class="w-full h-full object-cover" src="{{ asset($album->images[0]->file_url) }}" alt="Photo">
    <div class="about_title title_4">
        {{$details[0]->getLocalizedTranslation()}}
    </div>
    <div class="about_text text_4">
        @foreach($details as $text)
            @continue($loop->first)
            <p>
                {{$text->getLocalizedTranslation()}}
            </p>
        @endforeach
    </div>
    <div class="defense_copy"></div>
    <div class="div_for_button_work">
        <x-button-work></x-button-work>
    </div>
</div>

