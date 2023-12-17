<div id="application_form">
    <div id="title_form" class="align_center">
        {{$details[0]->getLocalizedTranslation()}}
    </div>
    <div class="main_inputs">
        <div class="input_flex">
            <div class="title_input">{{$details[1]->getLocalizedTranslation()}}</div>
            <div id="var_input_1">
                <select id="var_input_6">
                        @foreach($page->components as ['details'=>$detailsForm, 'isVisible'=>$visibleForm])
                            @continue($loop->first)
                             @if ($loop->count > $loop->iteration)
                                @if ($visibleForm === 'on')
                                    <option value="optionValue" class="option1">{{$detailsForm[0]->getLocalizedTranslation()}}</option>
                                @endif
                            @endif
                        @endforeach
                </select>
            </div>
        </div>
        <div class="input_flex">
            <div class="title_input">{{$details[2]->getLocalizedTranslation()}}</div>
            <input type="text" placeholder="Emmanuel" id="var_input_2">
        </div>
        <div class="input_flex">
            <div class="title_input">{{$details[3]->getLocalizedTranslation()}}</div>
            <input type="text" placeholder="Kant" id="var_input_3">
        </div>
        <div class="input_flex">
            <div class="title_input">{{$details[4]->getLocalizedTranslation()}}</div>
            <input type="text" placeholder="+4911111111111" id="var_input_4">
        </div>
        <div class="input_flex">
            <div class="title_input">{{$details[5]->getLocalizedTranslation()}}</div>
            <input type="date" id="var_input_5">
        </div>
    </div>
    <div class="submit align_center">
        <button id="button_send">{{$details[6]->getLocalizedTranslation()}}</button>
    </div>
</div>

