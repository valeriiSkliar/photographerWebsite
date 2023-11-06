@extends('layouts.app')
@section('metaData')
    <x-meta-data page_id="" />
@endsection
@section('content')
    @foreach($page->components as ['name'=>$name, 'album'=>$album, 'details'=>$details])
                @include('sectionComponents.frontend.'.$name)
@endforeach
<div id="application_form">
    <div class="title_form">

    </div>
    <div class="main_inputs">
        <div class="main_inputs_details">
            <div class="title_input">service:</div>
            <select class="var_input">
                <option value="wedding">wedding</option>
                <option value="session">session</option>
                <option value="event">event</option>
                <option value="albums">albums</option>
            </select>
        </div>
        <div class="main_inputs_details">
            <div class="title_input">name:</div>
            <input type="text" class="var_input">
        </div>
        <div class="main_inputs_details">
            <div class="title_input">surname:</div>
            <input type="text" class="var_input">
        </div>
        <div class="main_inputs_details">
            <div class="title_input">phone:</div>
            <input type="text" class="var_input">
        </div>
    </div>
    <div title_inputs_date>

    </div>
    <div class="inputs_dates_form">
        <div class="inputs_date">
            <div>day</div>
            <input type="text">
        </div>
        <div class="inputs_date">
            <div>month</div>
            <input type="text">
        </div>
        <div class="inputs_date">
            <div>year</div>
            <input type="text">
        </div>
    </div>
    <div class="submit">
        <button>Send</button>
    </div>
</div>
@endsection
