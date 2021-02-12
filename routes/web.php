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

////////////////////////////////////////////
// definir controladores para las rutas
///////////////////////////////////////////
use App\Http\Controllers\LugaresController;


Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('auth/social', 'App\Http\Controllers\Auth\LoginController@show')->name('social.login');
Route::get('oauth/{driver}', 'App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback')->name('social.callback');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// rutas para acceder con un usuario
Route::group(['middleware' => 'auth'], function () {
    // establecemos el prefijo para el usar la app con los usuarios
    Route::group(['prefix' => 'home'], function() { 
        // rutas para el modulo lugares
        Route::get('lugares',[LugaresController::class, 'index']);
    });
});