<div class="contacts_name_page">CONTACTS</div>
<div class="container_contacts">
   <div class="container_back">
        <div class="contacts_name">
            {{$details[0]->value}}
        </div>
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
        <div class="contacts_front">
            {{$details[1]->value}}
        </div>
        <div class="contacts_front contacts_align_right_front">
            {{$details[2]->value}}
        </div>
        <div class="contacts_front">
            {{$details[3]->value}}
        </div>
        <div class="contacts_front contacts_align_right_front">
            {{$details[4]->value}}
        </div>
   </div>
</div>
