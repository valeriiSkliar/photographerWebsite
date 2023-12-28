<div class="about_section">
    <img class="w-full h-full object-cover"
         srcset="{{ $album->images[0]->file_url_small }} 480w, {{ $album->images[0]->file_url_medium }} 768w, {{ $album->images[0]->file_url }} 1024w"
         src="{{ $album->images[0]->file_url_medium }}"
         alt="Photo">
    <div class="about_title title_5">
        {{$details[0]->getLocalizedTranslation()}}
    </div>
    <div class="about_text text_5">
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

