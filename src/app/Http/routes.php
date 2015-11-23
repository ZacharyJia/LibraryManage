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
    return redirect("/login");
});

Route::get('index','IndexController@dbTest');

Route::get('login', ['middleware' => 'login', 'uses' => 'IndexController@login']);

Route::post('loginAction', 'IndexController@loginAction');

Route::any('logoutAction', 'IndexController@logoutAction');

Route::group(['prefix' => 'admin', 'middleware'=>['AdminAuth']], function()
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

    Route::any('cardCreate', 'Admin\ReaderController@cardCreate');

    Route::post('cardCreateAction', 'Admin\ReaderController@cardCreateAction');

    Route::any('bookReturn', 'Admin\BookController@bookReturn');

    Route::post('bookReturnAction', 'Admin\BookController@bookReturnAction');

    Route::any('bookLoss', 'Admin\BookController@bookLoss');

    Route::post('bookLossAction', 'Admin\BookController@bookLossAction');

    Route::any('readerSearch', 'Admin\ReaderController@readerSearch');

    Route::any('readerSearchAction', 'Admin\ReaderController@readerSearchAction');

    Route::get('readerDetail', 'Admin\ReaderController@readerDetail');

    Route::post('readerSaveAction', 'Admin\ReaderController@readerSaveAction');

    Route::any('readerLoss', 'Admin\ReaderController@readerLoss');

    Route::post('readerLossAction', 'Admin\ReaderController@readerLossAction');

    Route::any('readerFound', 'Admin\ReaderController@readerFound');

    Route::post('readerFoundAction', 'Admin\ReaderController@readerFoundAction');

    Route::any('overTime', 'Admin\SystemController@overTime');

    Route::any('changePassword', 'Admin\SystemController@changePassword');

    Route::post('changePasswordAction', 'Admin\SystemController@changePasswordAction');

    Route::any('levelManage', 'Admin\SystemController@levelManage');

    Route::any('levelDel', 'Admin\SystemController@levelDel');

    Route::any('levelAdd', 'Admin\SystemController@levelAdd');

    Route::any('levelAddAction', 'Admin\SystemController@levelAddAction');

});

Route::group(['prefix' => 'reader', 'middleware'=>['UserAuth']], function()
{
    route::any('home', 'Reader\IndexController@home');

    route::any('search', 'Reader\IndexController@search');

    route::any('advancedSearch', 'Reader\IndexController@advancedSearch');

    route::any('advancedSearchAction', 'Reader\IndexController@advancedSearchAction');

    route::any('history', 'Reader\IndexController@history');

});