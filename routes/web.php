<?php

Route::get('/',    'SiteController@index')->name('front-page');
Route::get('home', 'SiteController@index');
Route::get('hjem', 'SiteController@index')->name('home');

Route::get('goodbye', function () {
	return view('auth.logout-success');
})->name('goodbye');

// Auth routes
Auth::routes();

// Reauthentication routes (also used for 2fa)
Route::get('auth/reauthenticate', 'Reauthenticates@getReauthenticate')->name('reauthenticate.show');
Route::post('auth/reauthenticate', 'Reauthenticates@postReauthenticate')->name('reauthenticate.post');
Route::post('auth/send_confirmation_code', 'Reauthenticates@sendConfirmationCode')->name('reauthenticate.send_confirmation_code');
Route::get('auth/send_confirmation_code', 'Reauthenticates@getReauthenticate');
Route::post('auth/deauthenticate', 'Reauthenticates@deauthenticate')->name('reauthenticate.deauthenticate');

// Socialite routes
Route::get('login/{provider}/terms_of_service',  'Auth\LoginController@oauthTos')->name('login.oauth.tos');
Route::post('login/{provider}/complete_signup', 'Auth\LoginController@oauthComplete')->name('login.oauth.complete');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.oauth');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.oauth.callback');

// User
Route::prefix('konto')->group(function () {
	Route::get('/',          'UserController@show')->name('user');
	Route::get('oppdater',   'UserController@show');
	Route::patch('oppdater', 'UserController@update')->name('user.update');

	Route::prefix('innstillinger')->group(function () {
		Route::get('/',          'UserController@show_settings')->name('user.settings');
		Route::prefix('sikkerhet')->group(function () {
			Route::get('/',  'UserController@show_settings_security')->name('user.settings.security');

			Route::get('bekreft/{token}', 'UserController@verify')->name('user.verify');

			Route::get('2fa_oppsett',  'UserController@setup_2fa')->name('user.setup_2fa');
			Route::post('2fa_oppsett', 'UserController@setup_2fa_complete')->name('user.setup_2fa_complete');

			Route::get('2fa_deaktiver',  'UserController@disable_2fa')->name('user.disable_2fa');
			Route::post('2fa_deaktiver', 'UserController@disable_2fa_complete')->name('user.disable_2fa_complete');

			Route::post('2fa_ny_hemmelighet', 'UserController@setup_2fa_new_secret')->name('user.setup_2fa_new_secret');
		});
	});
});

Route::prefix('bruker/{user}')->group(function () {
	Route::get('/', 'UserController@show');
	Route::get('oppdater',   'UserController@show');
	Route::patch('oppdater', 'UserController@update');
});
// Route::patch('/bruker/{user}/oppdater', 'UserController@update')->name('user.update');

// Dashboard routes
Route::prefix('dashboard')->group(function () {
	Route::get('/', 'DashboardController@index')->name('dashboard');

	Route::prefix('admin')->group(function () {
		Route::get('/', 'AdminController@index')->name('dashboard.admin');

		Route::prefix('entry_type')->group(function () {
			Route::get('ny',                      'EntryTypeController@create')->name('entry_type.create');
			Route::post('opprett',                'EntryTypeController@store')->name('entry_type.store');
			Route::get('{entry_type}/rediger',    'EntryTypeController@edit')->name('entry_type.edit');
			Route::patch('{entry_type}/oppdater', 'EntryTypeController@update')->name('entry_type.update');
			Route::get('{entry_type}/slett',      'EntryTypeController@delete')->name('entry_type.delete');
			Route::delete('{entry_type}/slett',   'EntryTypeController@destroy')->name('entry_type.destroy');
		});
	});

	Route::prefix('author')->group(function () {
		Route::get('/', 'AuthorController@index')->name('dashboard.author');
		Route::get('/{entry_type}', 'EntryTypeController@index')->name('dashboard.author.entry_type');
	});
});
});
