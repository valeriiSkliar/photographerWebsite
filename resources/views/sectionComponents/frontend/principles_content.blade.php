<div class="about_section">
    <img class="w-full h-full object-cover"
         srcset="{{ $album->images[0]->file_url_small }} 480w, {{ $album->images[0]->file_url_medium }} 768w, {{ $album->images[0]->file_url }} 1024w"
         src="{{ $album->images[0]->file_url_medium }}"
         alt="Photo">
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
