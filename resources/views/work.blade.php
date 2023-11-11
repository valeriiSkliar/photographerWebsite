@extends('layouts.app')
@section('content')
    @include('layouts.componentsFromDb')
    <div id="application_form">
        <div id="title_form" class="align_center">
            Please, complete your application
        </div>
        <div class="main_inputs">
            <div class="input_flex">
                <div class="title_input">service:</div>
                <div id="var_input_1">
                    <select id="var_input_6">
                        <option value="wedding" class="option1">wedding</option>
                        <option value="session" class="option1">session</option>
                        <option value="event" class="option1">event</option>
                        <option value="albums" class="option1">albums</option>
                    </select>
                </div>
            </div>
            <div class="input_flex">
                <div class="title_input">name:</div>
                <input type="text" id="var_input_2">
            </div>
            <div class="input_flex">
                <div class="title_input">surname:</div>
                <input type="text" id="var_input_3">
            </div>
            <div class="input_flex">
                <div class="title_input">phone:</div>
                <input type="text" id="var_input_4">
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
@endsection
@push('custom-script')
    @vite(['resources\js\front\work_page.js'])
@endPush

