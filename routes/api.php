<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\RegisterController@create');
});

Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'movies'
    ],
    function ($router) {
        Route::get('all', 'Api\MovieController@index');
        Route::get('getPage', 'Api\MovieController@getCurrentPage');
        Route::get('movie/{id}', 'Api\MovieController@show');
        Route::get('{id}/comments', 'Api\MovieCommentsController@getCurrentPage');
        Route::get('popular', 'Api\MovieController@getPopularMovies');
    }
);

Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'movies'
    ],
    function ($router) {
        Route::post('create', 'Api\MovieController@store');
        Route::post('{id}/like', 'Api\MovieController@likeMovie');
        Route::post('{id}/dislike', 'Api\MovieController@dislikeMovie');
        Route::post('{id}/comments', 'Api\MovieCommentsController@store');
    }
);

Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'genre'
    ],
    function ($router) {
        Route::get('all', 'Api\GenreController@index');
        Route::get('show', 'Api\GenreController@show');
    }
);

Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'user'
    ],
    function ($router) {
        Route::get('watchList', 'Api\WatchListController@get');
        Route::post('watchList', 'Api\WatchListController@add');
        Route::post('watchList/{watchList}/mark', 'Api\WatchListController@markAsWatched')->middleware('can:update,watchList');
        Route::post('watchList/{watchList}/unmark', 'Api\WatchListController@unmarkAsWatched')->middleware('can:update,watchList');
        Route::delete('watchList/{watchList}/remove', 'Api\WatchListController@remove')->middleware('can:delete,watchList');
    }
);
