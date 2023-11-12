<div class="contacts_name_page">CONTACTS</div>
<div class="container_contacts">
   <div class="container_back">
         @if(isset($contact['name']) && isset($contact['surname']))
        <div class="contacts_name">
            {{$contact['name'].' '.$contact['surname']}}
        </div>
        @endif
        <div class="contacts_half_opacity">
            Address
        </div>
        <div class="contacts_half_opacity contacts_align_right">
            Phone
        </div>
        <div class="contacts_half_opacity">
            E-mail
        </div>
        <div class="contacts_half_opacity contacts_align_right">
            Telegram
        </div>
   </div>
   <div class="container_front">
        @if(isset($contact['city']) && isset($contact['address']))
        <div class="contacts_front">
            {{$contact['city'].', '.$contact['address']}}
        </div>
        @endif
        @if(isset($contact['phone']))
        <div class="contacts_front contacts_align_right_front">
            {{$contact['phone']}}
        </div>
        @endif
        @if(isset($contact['email']))
        <div class="contacts_front">
            {{$contact['email']}}
        </div>
        @endif
        @if(isset($contact['telegram']))
        <div class="contacts_front contacts_align_right_front">
            {{$contact['telegram']}}
        </div>
        @endif
   </div>
</div>
