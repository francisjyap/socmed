<?php

/*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/

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

//AdminController
Route::get('/adminPanel', 'AdminController@index')->name('adminPanel');
Route::get('/getUsers', 'AdminController@getUsers')->name('getUsers');

//Helpers
Route::get('/profileSort/{id}/{type}', 'Helpers\CommonHelper@profileSort');

//ProfileController
Route::get('/', 'ProfileController@index')->name('home');
Route::get('/getProfiles', 'ProfileController@getProfiles');
Route::get('/viewProfile/{profile_id}', 'ProfileController@viewProfile')->name('viewProfile');

Route::get('/addProfile', 'ProfileController@create')->name('addProfile');
Route::post('/addProfile', 'ProfileController@store')->name('storeProfile');
Route::get('/editProfile/{profile_id}', 'ProfileController@edit')->name('editProfile');
Route::post('/editProfile', 'ProfileController@update')->name('updateProfile');
Route::post('/deleteProfile', 'ProfileController@delete')->name('deleteProfile');
Route::post('/setEmailSent', 'ProfileController@setEmailSent')->name('setEmailSent');
Route::post('/setMentionedProduct', 'ProfileController@setMentionedProduct')->name('setMentionedProduct');
Route::post('/setAffliateCode', 'ProfileController@setAffliateCode')->name('setAffliateCode');


//EmailController
Route::get('/addEmail/{profile_id}', 'EmailController@create')->name('addEmail');
Route::post('/addEmail', 'EmailController@store')->name('storeEmail');
Route::get('/editEmail/{email_id}', 'EmailController@edit')->name('editEmail');
Route::post('/editEmail', 'EmailController@update')->name('updateEmail');
Route::post('/deleteEmail', 'EmailController@destroy')->name('deleteEmail');

//WebsiteController
Route::get('/addWebsite/{profile_id}', 'WebsiteController@create')->name('addWebsite');
Route::post('/storeWebsite', 'WebsiteController@store')->name('storeWebsite');
Route::get('/editWebsite/{website_id}', 'WebsiteController@edit')->name('editWebsite');
Route::post('/updateWebsite', 'WebsiteController@update')->name('updateWebsite');
Route::post('/deleteWebsite', 'WebsiteController@destroy')->name('deleteWebsite');

//SocialMediaController
Route::get('/addAccount/{profile_id}', 'SocialMediaController@create')->name('addAccount');
Route::post('/addAccount', 'SocialMediaController@store')->name('storeAccount');
Route::get('/editAccount/{account_id}', 'SocialMediaController@edit')->name('editAccount');
Route::post('/editAccount', 'SocialMediaController@update')->name('updateAccount');
Route::post('/deleteAccount', 'SocialMediaController@destroy')->name('deleteAccount');

//InfluencerAffliateController
Route::post('/changeStatus', 'InfluencerAffliateController@changeStatus')->name('changeStatus');
Route::post('/editInfAff', 'InfluencerAffliateController@editInfAff')->name('editInfAff');
Route::get('/editInf/{id}', 'InfluencerAffliateController@editInf')->name('editInf');
Route::get('/editAff/{id}', 'InfluencerAffliateController@editAff')->name('editAff');

//LogController
Route::get('/getInfHistory/{id}', 'LogController@getInfHistory')->name('getInfHistory');
Route::get('/getAffHistory/{id}', 'LogController@getAffHistory')->name('getAffHistory');
Route::get('/getHistory/{id}/{type}', 'LogController@getHistory')->name('getHistory');
Route::post('/createHistory', 'LogController@createHistory')->name('createHistory');
Route::get('/editHistory/{id}', 'LogController@editHistory')->name('editHistory');
Route::post('/updateHistory', 'LogController@updateHistory')->name('updateHistory');

//NoteController
Route::get('/getNotes/{id}', 'NoteController@getNotes')->name('getNotes');
Route::get('/createInfluencer/{id}', 'NoteController@createInfluencer')->name('createInfluencer');
Route::get('/createAffliate/{id}', 'NoteController@createAffliate')->name('createAffliate');
Route::post('/addNote', 'NoteController@addNote')->name('addNote');
