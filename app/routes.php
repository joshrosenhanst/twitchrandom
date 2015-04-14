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
Route::get('/feature', array('uses'=>'HomeController@home'));
Route::get('/randomstream', array('uses'=>'HomeController@randomstream'));
Route::get('/randomgame', array('uses'=>'HomeController@randomgame'));
Route::get('/stream/{name}', array('uses'=>'HomeController@stream'));

//ajax calls
Route::group(array('prefix' => 'ajax'), function()
{
    Route::get('/randomStream', array('uses'=>'AjaxController@randomStream'));
    //Route::get('beta/randomStream', array('uses'=>'AjaxController@betaRandomStream'));
    Route::get('/stream/{name}', array('uses'=>'AjaxController@streamByName'));
    Route::get('/search/{search}', array('uses'=>'AjaxController@searchGames'));
    Route::get('/games/{limit}/{offset}', array('uses'=>'AjaxController@getAllGames'));
    Route::get('/game/{game}/{limit}', array('uses'=>'AjaxController@streamsByGame'));
    Route::get('/top/{game}', array('uses'=>'AjaxController@topStreamsByGame'));
    Route::get('/gallery', array('uses'=>'AjaxController@getGallery'));
    Route::get('/featured/{num}', array('uses'=>'AjaxController@getFeaturedGallery'));
    Route::get('/gallery/{game}', array('uses'=>'AjaxController@getGallery'));

});
//individual game pages
Route::group(array('prefix' => 'games'), function()
{
    Route::get('/', array('uses'=>'GameController@home'));
    //Route::get('/{game}', array('uses'=>'GameController@getGame'));
    /*Route::get('/{game}', function($game){
        return 'The URL is: '.rawurldecode($game);
    })->where("game", ".*");*/
    Route::get('/{game}', array('uses'=>'GameController@getGame'));
});