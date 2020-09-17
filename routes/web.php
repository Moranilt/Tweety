<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'TweetsController@main');

Route::middleware('auth')->group(function() {
  Route::get('/tweets', 'TweetsController@index')->name('home');
  Route::post('/tweets', 'TweetsController@store');
  Route::get('/tweets/{tweet}', 'TweetsController@show');

  Route::get('/chats', 'ChatsController@index')->name('chats.all');
  Route::post('/chats/{user:username}', 'ChatsController@create')->name('chats.create');
  Route::get('/chats/{chat}', 'ChatsController@show')->name('chats.show');
  Route::post('/chats/{chat}/send', 'ChatsController@store')->name('chats.send');

  Route::get('/notifications', 'NotificationsController@show');
  Route::patch('/notifications', 'NotificationsController@update')->name('notify.show');

  Route::post('/tweets/{tweet}/like', 'TweetLikesController@store');
  Route::delete('/tweets/{tweet}/like', 'TweetLikesController@destroy');

  Route::get('/followers/{user:username}', 'FollowsController@show')->name('followers.show');
  Route::post('/profiles/{user:username}/follow', 'FollowsController@store')->name('follow');
  Route::get('/profiles/{user:username}/edit', 'ProfilesController@edit')->middleware('can:edit,user');
  Route::patch('/profiles/{user:username}', 'ProfilesController@update')->middleware('can:edit,user');

  Route::post('/tweets/{tweet}/share', 'ShareTweetsController@store')->name('tweet.share');
  Route::get('/explore', 'ExploreController');
});

Route::get('/profiles/{user:username}', 'ProfilesController@show')->name('profile');


Auth::routes();
