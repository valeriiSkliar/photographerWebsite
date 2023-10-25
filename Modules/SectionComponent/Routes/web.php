<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin'], function() {
    Route::group(['prefix' => 'sectioncomponent', 'middleware' => ['web']], function() {
        Route::get('/{id}/pars', 'SectionComponentController@parsFrontendTemplate')->name('pars.frontend.template');
        Route::get('/', 'SectionComponentController@index')->name('sections_component.index');
        Route::get('/create', 'SectionComponentController@create')->name('sections_component.create');
        Route::post('/', 'SectionComponentController@store')->name('sections_component.store');
        Route::get('/{id}', 'SectionComponentController@show')->name('sections_component.show');
        Route::get('/{id}/edit', 'SectionComponentController@edit')->name('sections_component.edit');
        Route::put('/{id}', 'SectionComponentController@update')->name('sections_component.update');
        Route::delete('/{id}', 'SectionComponentController@destroy')->name('sections_component.destroy');
    });
});



