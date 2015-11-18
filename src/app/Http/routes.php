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

Route::get('index','IndexController@dbTest');

Route::get('login', ['middleware' => 'login', 'IndexController@login']);

Route::post('loginAction', 'IndexController@loginAction');

Route::any('logoutAction', 'IndexController@logoutAction');

Route::group(['prefix' => 'admin', 'middleware'=>['auth']], function()
{
    Route::any('home', 'Admin\IndexController@home');

    Route::any('bookSearch', 'Admin\BookController@bookSearch');


});