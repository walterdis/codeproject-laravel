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
    //var_dump($query);
});

Route::get('/', function () {
    return view('app');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});



Route::group(['middleware' => 'oauth'], function() {

    #$allowOwner = ['store', 'destroy'];
    #$allowMember = ['show', 'update'];

    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);
    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);

    Route::post('project/{project}/file', 'ProjectFileController@store');
    Route::put('project/{project}/file/{file}', 'ProjectFileController@update');
    Route::delete('project/{project}/file/{file}', 'ProjectFileController@destroy');

    Route::post('project/{id}/members', 'ProjectController@addMember');
    Route::delete('project/{id}/members/{member_id}', 'ProjectController@removeMember');
    Route::get('project/{id}/members', 'ProjectController@members');
    Route::get('project/{id}/ismember/{member_id}', 'ProjectController@isMember');

    Route::resource('project.tasks', 'ProjectTaskController', ['except' => ['create', 'edit']]);
    Route::resource('project.note', 'ProjectNoteController', ['except' => ['create', 'edit']]);

    #Route::group(['middleware' => 'check-project-member'], function() use ($allowMember) {
        #Route::resource('project', 'ProjectController', ['only' => $allowMember]);
    #});

});

