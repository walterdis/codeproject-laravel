<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('client', 'ClientController@index');
Route::post('client', 'ClientController@store');
Route::get('client/{id}', 'ClientController@show');
Route::delete('client/{id}', 'ClientController@destroy');
Route::put('client/{id}', 'ClientController@update');


Route::get('project/note', 'ProjectNoteController@index');
Route::post('project/note', 'ProjectNoteController@store');
Route::get('project/note/{id}', 'ProjectNoteController@show');
Route::delete('project/note/{id}', 'ProjectNoteController@destroy');
Route::put('project/note/{id}', 'ProjectNoteController@update');

Route::post('project/{id}/members', 'ProjectController@addMember');
Route::delete('project/{id}/members', 'ProjectController@removeMember');
Route::get('project/{id}/members', 'ProjectController@members');
Route::resource('project', 'ProjectController');
