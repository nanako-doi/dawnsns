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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/added', 'Auth\RegisterController@added');

Route::get('/top','PostsController@index');
Route::post('/top','PostsController@create');
Route::post('/post/{id}/update', 'PostsController@update');
Route::get('/post/{id}/delete', 'PostsController@delete');

Route::get('/profile','UsersController@profile');
Route::post('/profileup','UsersController@profileup');

Route::get('/personal-profile/{id}','UsersController@personalprofile');
Route::get('/personalfollow/{id}', 'UsersController@personalfollow');
Route::get('/personalunfollow/{id}', 'UsersController@personalunfollow');

Route::get('/search','UsersController@index');
Route::get('/search-result','UsersController@search');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');

Route::get('/follow/{id}', 'UsersController@follow');
Route::get('/unfollow/{id}', 'UsersController@unfollow');

Route::get('/logout','Auth\LoginController@logout');



