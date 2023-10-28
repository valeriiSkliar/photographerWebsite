<div class="about_section">
    <img class="w-full h-full object-cover" src="{{ asset($album->images[0]->file_url) }}" alt="Photo">
    <div class="about_title title_2">
        {{$details[0]->value}}
    </div>
    <div class="about_text text_2">
        {{$details[1]->value}}<br>
        {{$details[2]->value}}<br>
        {{$details[3]->value}}<br>
        {{$details[4]->value}}<br>
        {{$details[5]->value}}
    </div>
</div>
