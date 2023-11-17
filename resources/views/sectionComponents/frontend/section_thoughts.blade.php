<section class="thoughts relative mt-14">
    <img class="w-full h-full object-cover" src="{{ asset('assets/about_s_2.jpg') }}" alt="Photo">
    <h1 class="credo">
        {{$details[0]->value}}

    </h1>
    <div class="thoughts__text">
        @foreach($details as $text)
            @continue($loop->first)
            <p>
                {{$text->value}}
            </p>
        @endforeach
    </div>
</section>
