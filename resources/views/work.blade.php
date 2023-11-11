@extends('layouts.app')
@section('metaData')
    <x-meta-data page_id="" />
@endsection
@section('content')
    @foreach($page->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])
                @include('sectionComponents.frontend.'.$name)
@endforeach
<div id="application_form">
    <div id="title_form" class="align_center">
        Please, complete your application
    </div>
    <div class="main_inputs">
        <div class="input_flex">
            <div class="title_input">service:</div>
            <div id="var_input_1">
                <select id="var_input_6">
                    @foreach($page->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])
                        <option value="service" class="option1">{{$details[0]->value}}</option>
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
            <input type="text" placeholder="+4915111111111" id="var_input_4">
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

