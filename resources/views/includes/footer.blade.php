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
