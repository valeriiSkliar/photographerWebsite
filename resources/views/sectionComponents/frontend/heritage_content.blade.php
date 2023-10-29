<div class="about_section">
    <img class="w-full h-full object-cover" src="{{ asset($album->images[0]->file_url) }}" alt="Photo">
    <div class="about_title title_3">
        {{$details[0]->value}}
    </div>
    <div class="about_text text_1">
        @foreach($details as $text)
            @continue($loop->first)
            <p>
                {{$text->value}}
            </p>
        @endforeach
    </div>
</div>
