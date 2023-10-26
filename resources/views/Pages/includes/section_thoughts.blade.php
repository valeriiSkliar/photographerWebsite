<section class="thoughts relative">
    <img class="w-full h-full object-cover" src="{{ asset('assets/Section thoughts.png') }}" alt="Photo">
    <h1 class="credo absolute">
        {{$details[0]->value}}

    </h1>
    <div class="thoughts__text absolute">
        @foreach($details as $text)
            @continue($loop->first)
            <p>
                {{$text->value}}
            </p>
        @endforeach
    </div>
</section>
