<div class="about_section">
    <img class="w-full h-full object-cover" src="{{ asset($album->images[0]->file_url) }}" alt="Photo">
    <div class="about_title title_4">
        {{$details[0]->value}}
    </div>
    <div class="about_text text_4">
        @foreach($details as $text)
            @continue($loop->first)
            <p>
                {{$text->value}}
            </p>
        @endforeach
        <br>
        <x-button-work></x-button-work>
    </div>
</div>

