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

Route::get('/', 'LadiesController@index');

Route::group(['prefix' => 'schedules'], function(){
    Route::get('/', 'SchedulesController@index');
});

Route::group(['prefix' => 'ladyschedules'], function(){
    Route::get('/', 'LadySchedulesController@index');
    Route::post('/save', 'LadySchedulesController@saveSched');
});

Route::group(['prefix' => 'ladies'], function(){
    Route::get('/', 'LadiesController@index');
    Route::post('/', 'LadiesController@store');
    Route::post('/update', 'LadiesController@update');
    Route::get('/new', 'LadiesController@new');
    Route::get('/{id}/edit', 'LadiesController@edit');
    Route::get('/{id}/images', 'LadiesController@getImages');
    Route::post('/images', ['as'=>'image.upload','uses'=> 'LadiesController@storeImages']);
    Route::post('/{id}/images/{image_id}/delete', 'LadiesController@deleteImages');
});
