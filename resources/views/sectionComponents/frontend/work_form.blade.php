<div id="application_form">
    <div id="title_form" class="align_center">
        Please, complete your application
    </div>
    <div class="main_inputs">
        <div class="input_flex">
            <div class="title_input">service:</div>
            <div id="var_input_1">
                <select id="var_input_6">
                        @foreach($page->components as ['details'=>$detailsForm, 'isVisible'=>$visibleForm])
                             @if ($loop->count > $loop->iteration)
                                @if ($visibleForm === 'on')
                                    <option value="optionValue" class="option1">{{$detailsForm[0]->value}}</option>
                                @endif
                            @endif
                        @endforeach
                </select>
            </div>
        </div>
        <div class="input_flex">
            <div class="title_input">name:</div>
            <input type="text" placeholder="Emmanuel" id="var_input_2">
        </div>
        <div class="input_flex">
            <div class="title_input">surname:</div>
            <input type="text" placeholder="Kant" id="var_input_3">
        </div>
        <div class="input_flex">
            <div class="title_input">phone:</div>
            <input type="text" placeholder="+4911111111111" id="var_input_4">
        </div>
        <div class="input_flex">
            <div class="title_input">date:</div>
            <input type="date" id="var_input_5">
        </div>
    </div>
    <div class="submit align_center">
        <button id="button_send">Send</button>
    </div>
</div>

@push('custom-script')
    @vite(['resources/js/front/work_page123.js'])
@endPush
