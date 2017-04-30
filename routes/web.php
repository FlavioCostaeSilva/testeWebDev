<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix'=> '', 'where' => ['lm' => '[0-9]+']], function() {
    Route::get('/', ['as' => '.', 'uses' => 'indexController@index']);

    Route::post('/', ['as' => '.uploadFile', 'uses' => 'indexController@uploadfile']);

    Route::get('edit/{lm}', ['as' => '.edit', 'uses' => 'indexController@edit']);

    Route::get('delete/{lm}', ['as' => '.delete', 'uses' => 'indexController@delete']);

    Route::post('update', ['as' => '.update', 'uses' => 'indexController@update']);
});
