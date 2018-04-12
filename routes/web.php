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

//Profile
Route::get('/getProfiles', 'ProfileController@getProfiles');
Route::get('/viewProfile/{profile_id}', 'ProfileController@viewProfile')->name('viewProfile');

Route::get('/addProfile', 'ProfileController@create')->name('addProfile');
Route::post('/addProfile', 'ProfileController@store')->name('storeProfile');
Route::get('/editProfile/{profile_id}', 'ProfileController@edit')->name('editProfile');
Route::post('/editProfile', 'ProfileController@update')->name('updateProfile');
Route::post('/deleteProfile', 'ProfileController@delete')->name('deleteProfile');

Route::get('/profileSort/{id}/{type}', 'ProfileController@profileSort');

//Email
Route::get('/addEmail/{profile_id}', 'EmailController@create')->name('addEmail');
Route::post('/addEmail', 'EmailController@store')->name('storeEmail');
Route::get('/editEmail/{email_id}', 'EmailController@edit')->name('editEmail');
Route::post('/editEmail', 'EmailController@update')->name('updateEmail');
Route::post('/deleteEmail', 'EmailController@destroy')->name('deleteEmail');

//Social Media
Route::get('/addAccount/{profile_id}', 'SocialMediaController@create')->name('addAccount');
Route::post('/addAccount', 'SocialMediaController@store')->name('storeAccount');
Route::get('/editAccount/{account_id}', 'SocialMediaController@edit')->name('editAccount');
Route::post('/editAccount', 'SocialMediaController@update')->name('updateAccount');
Route::post('/deleteAccount', 'SocialMediaController@destroy')->name('deleteAccount');

//InfluencerAffliateController
Route::post('/changeStatus', 'InfluencerAffliateController@changeStatus')->name('changeStatus');

//LogController
Route::get('/getInfHistory/{id}', 'LogController@getInfHistory')->name('getInfHistory');
Route::get('/getAffHistory/{id}', 'LogController@getAffHistory')->name('getAffHistory');
