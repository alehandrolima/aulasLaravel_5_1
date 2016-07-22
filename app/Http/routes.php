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
// route client
Route::get('client', 'ClientController@index');
Route::post('client', 'ClientController@store');
Route::get('client/{id}', 'ClientController@show');
Route::delete('client/{id}', 'ClientController@delete');
Route::put('client/{id}', 'ClientController@update');

// route project note
Route::get('project/{id}/note', 'ProjectNoteController@index');
Route::post('project/{id}/note', 'ProjectNoteController@store');
Route::get('project/{id}/note/{noteId}', 'ProjectNoteController@show');
Route::delete('project/{id}/note/{noteId}', 'ProjectNoteController@delete');
Route::put('project/{id}/note/{noteId}', 'ProjectNoteController@update');

// route project members
Route::get('project/{id}/members', 'ProjectMembersController@index');
Route::post('project/{id}/members', 'ProjectMembersController@store');
Route::get('project/{id}/members/{idMember}', 'ProjectMembersController@show');
Route::delete('project/{id}/members/{idMember}', 'ProjectMembersController@delete');
//Route::put('project/{id}/members/{idMember}', 'ProjectMembersController@update');

//route project task
Route::get('project/{id}/task', 'ProjectTaskController@index');
Route::post('project/{id}/task', 'ProjectTaskController@store');
Route::get('project/{id}/task/{taskId}', 'ProjectTaskController@show');
Route::delete('project/{id}/task/{taskId}', 'ProjectTaskController@delete');
Route::put('project/{id}/task/{taskId}', 'ProjectTaskController@update');

// route project
Route::get('project', 'ProjectController@index');
Route::post('project', 'ProjectController@store');
Route::get('project/{id}', 'ProjectController@show');
Route::delete('project/{id}', 'ProjectController@delete');
Route::put('project/{id}', 'ProjectController@update');







