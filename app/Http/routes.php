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

Route::get('/', ['as' => 'index', 'middleware' => 'auth', function() {
    return view('index');
}]);

Route::group(['prefix' => 'game-download-link', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'GameDownloadLinkController@index', 'as' => 'game_download_link.index']);
    Route::put('{id}', ['uses' => 'GameDownloadLinkController@update', 'as' => 'game_download_link.update']);
});

Route::group(['prefix' => 'auth'], function() {
    Route::get('redirect', ['as' => 'auth.redirect', 'uses' => 'LoginController@redirectToProvider']);
    Route::get('login', array('as' => 'login', 'uses' => 'LoginController@loginWithGoogle'));
    Route::get('logout', array('as' => 'auth.logout', 'uses' => 'LoginController@logoutGoogle'));
});

Route::group(['prefix' => 'news', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'NewsController@index', 'as' => 'news.index']);
    Route::get('{id}', ['uses' => 'NewsController@show', 'as' => 'news.show']);
    Route::get('create', ['uses' => 'NewsController@create', 'as' => 'news.create']);
    Route::post('/', ['uses' => 'NewsController@store', 'as' => 'news.store']);
    Route::get('{id}/edit', ['uses' => 'NewsController@edit', 'as' => 'news.edit']);
    Route::put('{id}', ['uses' => 'NewsController@update', 'as' => 'news.update']);
    Route::delete('{id}', ['uses' => 'NewsController@destroy', 'as' => 'news.destroy']);
    Route::get('{id}/update', ['uses' => 'NewsController@updateTopStatus', 'as' => 'news.update.top']);
    Route::get('search', ['uses' => 'NewsController@search', 'as' => 'news.search']);
});

Route::group(['prefix' => 'banner', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'BannerController@index', 'as' => 'banner.index']);
    Route::get('create', ['uses' => 'BannerController@create', 'as' => 'banner.create']);
    Route::post('/', ['uses' => 'BannerController@store', 'as' => 'banner.store']);
    Route::get('{id}/edit', ['uses' => 'BannerController@edit', 'as' => 'banner.edit']);
    Route::put('{id}', ['uses' => 'BannerController@update', 'as' => 'banner.update']);
    Route::delete('{id}', ['uses' => 'BannerController@destroy', 'as' => 'banner.destory']);
    Route::get('search', ['uses' => 'BannerController@search', 'as' => 'banner.search']);
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'UserController@index', 'as' => 'user.index']);
    Route::get('{id}', ['uses' => 'UserController@show', 'as' => 'user.show']);
    Route::get('create', ['uses' => 'UserController@create', 'as' => 'user.create']);
    Route::post('/', ['uses' => 'UserController@store', 'as' => 'user.store']);
    Route::get('{id}/edit', ['uses' => 'UserController@edit', 'as' => 'user.edit']);
    Route::put('{id}', ['uses' => 'UserController@update', 'as' => 'user.update']);
    Route::delete('{id}', ['uses' => 'UserController@destroy', 'as' => 'user.destroy']);
    Route::get('search', ['uses' => 'UserController@search', 'as' => 'user.search']);
});

Route::group(['prefix' => 'group', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'GroupController@index', 'as' => 'group.index']);
    Route::get('{id}', ['uses' => 'GroupController@show', 'as' => 'group.show']);
    Route::get('create', ['uses' => 'GroupController@create', 'as' => 'group.create']);
    Route::post('/', ['uses' => 'GroupController@store', 'as' => 'group.store']);
    Route::get('{id}/edit', ['uses' => 'GroupController@edit', 'as' => 'group.edit']);
    Route::put('{id}', ['uses' => 'GroupController@update', 'as' => 'group.update']);
    Route::delete('{id}', ['uses' => 'GroupController@destroy', 'as' => 'group.destroy']);
    Route::get('search', ['uses' => 'GroupController@search', 'as' => 'group.search']);
});

Route::group(['prefix' => 'group-power', 'middleware' => 'auth'], function() {
    Route::get('/', ['uses' => 'GroupPowerController@index', 'as' => 'group_power.index']);
    Route::any('/change', ['uses' => 'GroupPowerController@change', 'as' => 'group_power.change']);
});

Route::group(['prefix' => 'menu', 'middleware' => 'auth'], function() {   
    Route::get('/', ['uses' => 'MenuController@index', 'as' => 'menu.index']);
    Route::get('{id}', ['uses' => 'MenuController@show', 'as' => 'menu.show']);
    Route::get('create', ['uses' => 'MenuController@create', 'as' => 'menu.create']);
    Route::post('/', ['uses' => 'MenuController@store', 'as' => 'menu.store']);
    Route::get('{id}/edit', ['uses' => 'MenuController@edit', 'as' => 'menu.edit']);
    Route::put('{id}', ['uses' => 'MenuController@update', 'as' => 'menu.update']);
    Route::delete('{id}', ['uses' => 'MenuController@destroy', 'as' => 'menu.destroy']);
    Route::get('{id}/update', ['uses' => 'MenuController@updateTopStatus', 'as' => 'menu.update.top']);
});