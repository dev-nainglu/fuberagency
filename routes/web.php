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

Route::get('/', function () {
    return view('dashboard.main');
});

Route::group(['prefix' => 'schedules'], function(){
    Route::get('/', 'SchedulesController@index');
    Route::get('/data', 'SchedulesController@getData');
});

Route::group(['prefix' => 'ladyschedules'], function(){
    Route::get('/', 'LadySchedulesController@index');
    Route::get('/data', 'LadySchedulesController@getData');
});

Route::group(['prefix' => 'ladies'], function(){
    Route::resource('/', 'LadiesController');
    Route::get('/new', 'LadiesController@new');
    Route::get('/{id}/images', 'LadiesController@getImages');
    Route::post('/images', ['as'=>'image.upload','uses'=> 'LadiesController@storeImages']);
    Route::post('/{id}/images/{image_id}/delete', 'LadiesController@deleteImages');
});

Route::resource('task', 'SchedulesController');
Route::resource('link', 'LinkController');