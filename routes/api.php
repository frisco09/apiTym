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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//user routes
Route::resource('Users','User\userController',['except'=>['create','edit']]);
Route::resource('Users.partidos','User\UserPartidoController',['only'=>['index','show']]);
Route::name('verify')->get('Users/verify/{token}', 'User\userController@verify');
Route::name('resend')->get('Users/{user}/resend', 'User\userController@resend');
//partidos routes
Route::resource('partidos','Partido\partidoController',['except'=>['create','edit']]);
Route::resource('partidos.users','Partido\PartidoUserController',['only'=>['index','show']]);
Route::resource('partidos.resultados','Partido\PartidoResultadoController',['only'=>['index','show']]);

//resultados routes
Route::resource('resultados','Resultado\resultadoController',['except'=>['create','edit']]);
Route::resource('resultados.partidos','Resultado\ResultadoPartidoController',['only'=>['index','show']]);



Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');