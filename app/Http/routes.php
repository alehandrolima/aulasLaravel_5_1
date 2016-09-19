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

Route::post('oauth/access_token', function (){
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware'=>'oauth'], function (){

    Route::resource('client','ClientController', ['except' => ['create', 'edit']]);

    //Route::group(['middleware'=>'CheckProjectOwner'], function (){
    //    Route::resource('project','ProjectController', ['except' => ['create', 'edit']]);
    //});

    Route::resource('project','ProjectController', ['except' => ['create', 'edit']]);


    Route::group(['prefix'=>'project'], function (){
        // route file
        Route::post('{id}/file', 'ProjectFileController@store');

        // route project note
        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@delete');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');

        // route project members
        Route::get('{id}/members', 'ProjectMembersController@index');
        Route::post('{id}/members', 'ProjectMembersController@store');
        Route::get('{id}/members/{idMember}', 'ProjectMembersController@show');
        Route::delete('{id}/members/{idMember}', 'ProjectMembersController@delete');

        //route project task
        Route::get('{id}/task', 'ProjectTaskController@index');
        Route::post('{id}/task', 'ProjectTaskController@store');
        Route::get('{id}/task/{taskId}', 'ProjectTaskController@show');
        Route::delete('{id}/task/{taskId}', 'ProjectTaskController@delete');
        Route::put('{id}/task/{taskId}', 'ProjectTaskController@update');
    });
});









