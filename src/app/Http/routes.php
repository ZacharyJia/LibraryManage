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

    Route::any('bookSearchAction', 'Admin\BookController@bookSearchAction');

    Route::get('bookDetail', 'Admin\BookController@bookDetail');

    Route::post('bookEdit', 'Admin\BookController@bookSave');

    Route::any('bookIn', 'Admin\BookController@bookIn');

    Route::post('bookInAction', 'Admin\BookController@bookInAction');

    Route::any('bookBorrow', 'Admin\BookController@bookBorrow');

    Route::post('bookBorrowAction', 'Admin\BookController@bookBorrowAction');

});