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


Route::get('/', function () {
    return view('welcome');
});
*/
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/home/my-tokens', 'HomeController@getTokens')->name('personal-tokens');
Route::get('/home/my-clients', 'HomeController@getClients')->name('personal-clients');
Route::get('/home/authorized-clients', 'HomeController@getAuthorizedClients')->name('authorized-clients');
Route::get('/home/usertoken','HomeController@getTokensUsers')->name('token-users');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function() {
	return view('welcome');
})->middleware('guest');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//user view
Route::get('/users/index','HomeController@getUsersList')->name('lista-usuarios')->middleware('auth', 'role:admin');
Route::get('/users/create','HomeController@getUsersCreate')->name('create-users')->middleware('auth', 'role:admin');
Route::get('/users/roles','HomeController@getUsersRoles')->name('home-roles')->middleware('auth', 'role:admin');
Route::get('/users/create/roles','HomeController@getUsersCreateRoles')->name('home-create-roles')->middleware('auth', 'role:admin');
Route::get('/users/roles/{id}', 'HomeController@changeRole')->name('change-role');
Route::get('/build/site','HomeController@inBuild')->name('build');

Route::get('user/api',[
	'as' => 'user.api',
	'uses' => 'User\UserViewController@index'
])->middleware('auth', 'role:admin');
Route::get('users',[
	'as' => 'users.index',
	'uses' => 'User\UserViewController@index'
])->middleware('auth', 'role:admin');

//Route::get('form-validation', 'HomeController@formValidation');
Route::post('form-validation', 'HomeController@formValidationPost')->middleware('auth', 'role:admin');
//Route::post('form-validation','User\userController@store');
Route::get('notification', 'HomeController@notification')->middleware('auth', 'role:admin');
Route::get('users/edit/{id}','HomeController@editUser')->middleware('auth', 'role:admin');
Route::post('user/edit/{id}','HomeController@update')->name('HomeController')->middleware('auth', 'role:admin');
Route::get('user/delete/{id}','HomeController@destroy')->name('HomeDestroy')->middleware('auth', 'role:admin');

Auth::routes();

Route::resource('/photo', 'PhotoController');

