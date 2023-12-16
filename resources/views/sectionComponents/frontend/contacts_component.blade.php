<div class="container_contacts">
   <div class="container_back">
         @if(isset($contact['name']) && isset($contact['surname']))
        <div class="contacts_name">
            {{$details[0]->value}}
        </div>
        @endif
        @foreach($details as $text)
        @continue($loop->first)
            @if ($loop->even)
                <div class="contacts_half_opacity">
                    {{$text->getLocalizedTranslation()}}
                </div>
            @endif
            @if ($loop->odd)
            <div class="contacts_half_opacity contacts_align_right">
                {{$text->getLocalizedTranslation()}}
            </div>
        @endif
    @endforeach
   </div>
   <div class="container_front">
        @foreach($details as $text)
            @continue($loop->first)
                @if ($loop->even)
                    <div class="contacts_front">
                        {{$contact[$text->key]}}
                    </div>
                @endif
                @if ($loop->odd)
                <div class="contacts_front contacts_align_right_front">
                        {{$contact[$text->key]}}
                </div>
            @endif
        @endforeach
   </div>
</div>
