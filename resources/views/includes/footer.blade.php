<div class="container_footer">
    <div class="data_footer data_footer_left">
        @if(isset($contact['name']) && isset($contact['surname']))
        <a href="{{ route(linkByLocale()) }}" class="name_footer">
            {{$contact['name']}}
        </a>
        <br>
        <a href="{{ route(linkByLocale()) }}" class="name_footer">
            {{$contact['surname']}}
        </a>
        @endif
    </div>
    {{-- <div class="data_footer_center">
        <a href="{{$contact['instagram']}}" class="instagram_icon_footer">
            <svg viewBox="0 0 256 256" width="100%" height="100%" fill="white">
            <path d="M128,82a46,46,0,1,0,46,46A46.05239,46.05239,0,0,0,128,82Zm0,80a34,34,0,1,1,34-34A34.03864,
            34.03864,0,0,1,128,162ZM172,30H84A54.06156,54.06156,0,0,0,30,84v88a54.06156,54.06156,0,0,0,54,
            54h88a54.06156,54.06156,0,0,0,54-54V84A54.06156,54.06156,0,0,0,172,30Zm42,142a42.04718,42.04718,0,0,
            1-42,42H84a42.04718,42.04718,0,0,1-42-42V84A42.04718,42.04718,0,0,1,84,42h88a42.04718,42.04718,0,0,1,
            42,42ZM190,76a10,10,0,1,1-10-10A10.01177,10.01177,0,0,1,190,76Z"/>
         </svg>
    </div> --}}
    <div class="data_footer data_footer_right">
        @if(isset($contact['name']) && isset($contact['surname']))
        <a href="{{ route(linkByLocale()) }}" class="name_footer name_footer_reserve">
            {{$contact['name'].' '.$contact['surname']}}
        </a>
        @endif
        @if(isset($contact['address']) && isset($contact['phone']) && isset($contact['email']))
        <div class="address_footer">
            {{$contact['address']}}<br>
            @if (app()->getLocale() === 'en')
                phone:
            @endif
            @if (app()->getLocale() === 'de')
                telefonnummer:
            @endif{{$contact['phone']}}<br>
            {{'e-mail: '.$contact['email']}}
        </div>
        @endif
    </div>
</div>
