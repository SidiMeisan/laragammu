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
    return view('login');
});

Route::post('authenticate', ['as'=>'login.process', 'uses'=>'Sentinel\AuthController@authenticate']);
Route::get('logout', ['uses'=>'Sentinel\AuthController@logout'])->middleware(['webAuth']);
Route::group(['middleware' => ['web']], function () {
    Route::get('login', function() {
		return view('login');
	});

	Route::get('dashboard', ['as'=>'dashboard', 'uses'=>'DashboardController@index']);

	Route::get('sendsms', ['as'=>'sendsms', 'uses'=>'SMSController@sendsms']);
	Route::post('sendsms', ['as'=>'sendsms', 'uses'=>'SMSController@sendMessage']);

	Route::get('inbox', ['as'=>'inbox', 'uses'=>'SMSController@inbox']);
	Route::post('inbox/delete', ['as'=>'inbox.delete', 'uses'=>'SMSController@destroyInbox']);
	Route::get('inbox/detail/{id}', ['as'=>'inbox.detail', 'uses'=>'SMSController@detailInbox']);
	Route::get('inbox/reply/{id}', ['as'=>'inbox.reply', 'uses'=>'SMSController@replyInbox']);

	Route::get('outbox', ['as'=>'outbox', 'uses'=>'SMSController@outbox']);
	Route::post('outbox/delete', ['as'=>'outbox.delete', 'uses'=>'SMSController@destroyOutbox']);

	Route::get('phonebook', ['as'=>'phonebook', 'uses'=>'SMSController@phonebook']);
	Route::get('phonebook/create', ['as'=>'phonebook.create', 'uses'=>'SMSController@createPhonebook']);
	Route::post('phonebook/store', ['as'=>'phonebook.store', 'uses'=>'SMSController@storePhonebook']);
	Route::get('phonebook/edit/{id}', ['as'=>'phonebook.edit', 'uses'=>'SMSController@editPhonebook']);
	Route::get('phonebook/delete/{id}', ['as'=>'phonebook.delete', 'uses'=>'SMSController@destroyPhonebook']);
	Route::post('phonebook/update/{id}', ['as'=>'phonebook.update', 'uses'=>'SMSController@updatePhonebook']);
	Route::get('phonebook/detail/{id}', ['as'=>'phonebook.detail', 'uses'=>'SMSController@detailPhonebook']);
	Route::post('phonebook/store/phone', ['as'=>'phonebook.store.phone', 'uses'=>'SMSController@storePhone']);

	Route::get('cekpulsa', ['as'=>'cekpulsa', 'uses'=>'SMSController@cekpulsa']);
	Route::post('cekpulsa', ['as'=>'cekpulsa', 'uses'=>'SMSController@ajax_cek_pulsa']);

	Route::group(['middleware' => ['pageAccess']], function () {
		Route::get('users/list', ['as'=>'user.list', 'uses'=>'Sentinel\UserController@index']);
		Route::get('groups/tambah', ['as'=>'group.tambah', 'uses'=>'Sentinel\UserController@groupIndex']);
	});
	
});