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

Event::listen('illuminate.query', function($query)
{
    #var_dump($query);
});

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::get('client', 'ClientController@index');
Route::post('client', 'ClientController@store');
Route::get('client/{id}', 'ClientController@show');
Route::delete('client/{id}', 'ClientController@destroy');
Route::put('client/{id}', 'ClientController@update');


Route::get('project/{id}/note', 'ProjectNoteController@index');
Route::post('project/{id}/note', 'ProjectNoteController@store');
Route::get('project/{id}/note/{note_id}', 'ProjectNoteController@show');
Route::put('project/{id}/note/{note_id}', 'ProjectNoteController@update');
Route::delete('project/{id}/note/{note_id}', 'ProjectNoteController@destroy');


Route::post('project/{id}/members', 'ProjectController@addMember');
Route::delete('project/{id}/members/{member_id}', 'ProjectController@removeMember');
Route::get('project/{id}/members', 'ProjectController@members');
Route::get('project/{id}/ismember/{member_id}', 'ProjectController@isMember');


Route::get('project/{id}/tasks', 'ProjectTaskController@index');
Route::post('project/{id}/tasks', 'ProjectTaskController@store');
Route::get('project/{id}/tasks/{task_id}', 'ProjectTaskController@show');
Route::put('project/{id}/tasks/{task_id}', 'ProjectTaskController@update');
Route::delete('project/{id}/tasks/{task_id}', 'ProjectTaskController@destroy');



Route::resource('project', 'ProjectController');
