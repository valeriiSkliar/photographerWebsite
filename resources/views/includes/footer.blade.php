<div class="container_footer">
{{--    Ось так можеш користуватися контактами. На фронт ти отримуєш нільки ті поля які заповнені в базі даних--}}
    {{-- @foreach($contact as $key => $value)
        {{ $key }}: {{ $value }} <br>
    @endforeach --}}
    {{-- @dd($contact->name) --}}
{{--    --}}

    <div class="data_footer">
        @if(isset($contact['name']) && isset($contact['surname']))
        <div class="text_footer name_footer">
            {{$contact['name'].' '.$contact['surname']}}
        </div>
        @endif
        @if(isset($contact['phone']))
        <div class="text_footer">
            {{'phone: '.$contact['phone']}}
        </div>
        @endif
    </div>
    <div class="logo_footer">
        <a href="{{ url('/') }}" class="link_logo">
            <img src="assets/logo/logo_nav.svg" width="90px" height="60px" alt="site name" title="site name">
        </a>
    </div>
    <div class="data_footer">
        @if(isset($contact['city']) && isset($contact['address']))
        <div class="text_footer address_footer">
            {{$contact['city'].', '.$contact['address']}}
        </div>
        @endif
        @if(isset($contact['email']))
        <div class="text_footer">
            {{'e-mail: '.$contact['email']}}
        </div>
        @endif
    </div>
</div>



{{-- @foreach($page->sections as $section)
    @if($section->components)
        @foreach($section->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])
                @include('sectionComponents.frontend.footer_components')
        @endforeach
    @endif
@endforeach --}}
