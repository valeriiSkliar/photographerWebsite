<div class="container_footer">
{{--    Ось так можеш користуватися контактами. На фронт ти отримуєш нільки ті поля які заповнені в базі даних--}}
    {{-- @foreach($contact as $key => $value)
        {{ $key }}: {{ $value }} <br>
    @endforeach --}}
    {{-- @if(isset($contact['name']))
    <div>
        {{$contact['name']}}
    </div>
    @endif --}}
    {{-- @dd($contact->name) --}}
{{--    --}}

    <div class="data_footer">
        <div class="text_footer name_footer">Olena Yavorska</div>
        <div class="text_footer">phone: +380961234578</div>
    </div>
    <div class="logo_footer">
        <a href="{{ url('/') }}" class="link_logo">
            <img src="assets/logo/logo_nav.svg" width="90px" height="60px" alt="site name" title="site name">
        </a>
    </div>
    <div class="data_footer">
        <div class="text_footer address_footer">Odesa city, Deribasivka str., 18</div>
        <div class="text_footer">e-mail: yavorskaphotografy@gmail.com</div>
    </div>
</div>



{{-- @foreach($page->sections as $section)
    @if($section->components)
        @foreach($section->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])
                @include('sectionComponents.frontend.footer_components')
        @endforeach
    @endif
@endforeach --}}
