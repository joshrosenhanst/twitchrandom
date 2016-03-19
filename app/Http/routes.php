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


//dev pages
Route::group(array('prefix' => 'dev'), function(){
    Route::get('/', array(function(){
        return Redirect::to("/");
    }));
    Route::get('/mobiletest', array('uses'=>'DevController@mobiletest'));
});

$this->get('login', 'Auth\AuthController@showLoginForm');

Route::get('/', array('uses'=>'HomeController@home'));
//Route::get('/feature', array('uses'=>'HomeController@home'));
Route::get('/randomstream', array('uses'=>'HomeController@randomstream'));
Route::get('/randomgame', array('uses'=>'HomeController@randomgame'));
Route::get('/featured', array('uses'=>'FeatureController@index'));
Route::get('/missing', array('uses'=>'HomeController@missing'));

//ajax calls
Route::group(array('prefix' => 'ajax'), function()
{
    Route::get('/randomStream/{slogan?}', array('uses'=>'AjaxController@randomStream'));
    //Route::get('beta/randomStream', array('uses'=>'AjaxController@betaRandomStream'));
    Route::get('/stream/{name}/{slogan?}', array('uses'=>'AjaxController@streamByName'));
    Route::get('/search/{search}', array('uses'=>'AjaxController@searchGames'));
    Route::get('/games/{limit}/{offset}', array('uses'=>'AjaxController@getAllGames'));
    Route::get('/game/{game}/{limit}/{slogan?}', array('uses'=>'AjaxController@streamsByGame'));
    Route::get('/top/{game}', array('uses'=>'AjaxController@topStreamsByGame'));
    Route::get('/gallery', array('uses'=>'AjaxController@getGallery'));
    Route::get('/featured/{num?}', array('uses'=>'AjaxController@getFeaturedGallery'));
    Route::get('/gallery/{game}', array('uses'=>'AjaxController@getGallery'));

});

//individual channel pages
Route::group(array('prefix' => 'stream'), function(){
    Route::get('/', array(function(){
        return Redirect::to("/");
    }));
    Route::get('/{name}', array('uses'=>'HomeController@stream'));
});

//user slogan pages
Route::group(array('prefix' => 'slogans'), function(){
    Route::get('/', array('uses'=>'SloganController@index'));
    Route::post('/', array('uses'=>'SloganController@create'));
    //admin controls
});

//individual game pages
Route::group(array('prefix' => 'games'), function(){
    Route::get('/', array('uses'=>'GameController@home'));
    Route::get('/{game}', array('uses'=>'GameController@getGame'));
});

//individual game pages
Route::group(array('prefix' => 'game'), function(){
    Route::get('/', array('uses'=>'GameController@home'));
    Route::get('/{game}', array('uses'=>'GameController@getGame'));
});

//admin pages
Route::group(array('prefix' => 'admin', 'middleware'=>'auth'), function(){
    Route::get('/', array('uses'=>'AdminController@index'));
    Route::group(array('prefix' => 'slogans'), function(){
        Route::get('/', array('uses'=>'SloganController@admin'));
        Route::post('/', array('uses'=>'SloganController@adminCreate'));
        Route::get('/{id}/approve', array('uses'=>'SloganController@approve'));
        Route::get('/{id}/reject', array('uses'=>'SloganController@reject'));
        Route::get('/{id}/destroy', array('uses'=>'SloganController@destroy'));
    });

    Route::group(array('prefix' => 'features'), function(){
        Route::get('/', array('uses'=>'FeatureController@admin'));
        Route::get('/new', array('uses'=>'FeatureController@new'));
        Route::post('/create', array('uses'=>'FeatureController@create'));
        Route::get('/{id}/edit', array('uses'=>'FeatureController@edit'));
        Route::post('/update', array('uses'=>'FeatureController@update'));
        Route::get('/{id}/destroy', array('uses'=>'FeatureController@destroy'));
    });
});
