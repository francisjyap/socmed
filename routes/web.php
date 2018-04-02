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

Auth::routes();

Route::get('/', 'ProfileController@index')->name('home');
Route::get('/getProfiles', 'ProfileController@getProfiles');
Route::get('/viewProfile/{profile_id}', 'ProfileController@viewProfile')->name('viewProfile');

Route::get('/addProfile', 'ProfileController@addProfile')->name('addProfile');
Route::post('/addProfile', 'ProfileController@store');

Route::get('/editProfile', 'ProfileController@editProfile')->name('editProfile');
Route::post('/editProfile', 'ProfileController@update');

Route::get('/addEmail/{profile_id}', 'EmailController@create')->name('addEmail');
Route::post('/addEmail', 'EmailController@store')->name('storeEmail');

Route::get('/addAccount/{profile_id}', 'SocialMediaController@create')->name('addAccount');
Route::post('/addAccount', 'SocialMediaController@store')->name('storeAccount');