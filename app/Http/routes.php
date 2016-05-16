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

Route::auth();

Route::get('/students', 'StudentsController@index');

Route::get('/students/{id}', 'StudentsController@show');

// get to the add new homework view

Route::get('/homework/create', 'HomeworkController@create');

Route::post('/homework', 'HomeworkController@store');

Route::get('/homework-delete/{homework_id}', 'HomeworkController@destroy');

Route::get('/homework/{homework_id}/edit', 'HomeworkController@edit');

Route::patch('/homework/{homework_id}', 'HomeworkController@update');

Route::post('/mark', 'HomeworkController@mark');

Route::post('/comment', 'CommentController@store');

Route::post('/comment-delete/{id}', 'CommentController@destroy');

Route::get('/comment/edit/{id}', 'CommentController@edit');

Route::post('/comment/update/{id}', 'CommentController@update');

// Account routes

Route::get('/account/edit', 'AccountController@edit');

Route::post('/account/update', 'AccountController@update');





// Route::post('/students/{id}/homework', 'StudentsController@show');
