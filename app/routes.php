<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses'=>'HomeController@home'));
Route::get('/stream/{name}', array('uses'=>'HomeController@stream'));

//ajax calls
Route::group(array('prefix' => 'ajax'), function()
{
    Route::get('/randomStream', array('uses'=>'AjaxController@randomStream'));
    Route::get('/stream/{name}', array('uses'=>'AjaxController@streamByName'));
    Route::get('/gallery', array('uses'=>'AjaxController@getGallery'));

});
//individual game pages
Route::group(array('prefix' => 'game'), function()
{
    Route::get('/', array('uses'=>'GameController@home'));
    Route::get('/{name}', array('uses'=>'GameController@getGame'));

});