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
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PlacesController;

// ruta para testear
Route::get('/test', function () {
    return view('test');
});

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
        Route::get('lugares',[LugaresController::class, 'index'])->name('lugares');
        //rutas para obtener los datos de las categorias
        Route::get('categories-list',[CategoriesController::class, 'list'])->name('categories-list');
        //rutas para obtener los datos de las actividades
        Route::get('activities-list',[ActivitiesController::class, 'list'])->name('activities-list');
        //rutas para obtener la actividad especifica
        Route::get('activity/{id}',[ActivitiesController::class, 'show'])->name('activity');
        //rutas para crear una actividad
        Route::get('create-activity',[ActivitiesController::class, 'create'])->name('create-activity');
        //rutas para guardar una actividad
        Route::post('save-activity',[ActivitiesController::class, 'store'])->name('save-activity');
        //rutas para editar la actividad
        Route::get('edit-activity/{id}',[ActivitiesController::class, 'edit'])->name('edit-activity');
        //rutas para actualizar una actividad
        Route::post('update-activity',[ActivitiesController::class, 'update'])->name('update-activity');
        //rutas para eliminar una actividad
        Route::post('delete-activity',[ActivitiesController::class, 'destroy'])->name('delete-activity');

        /* rutas para el modulo de categorias */
        Route::get('categories',[CategoriesController::class, 'index'])->name('categories');
        // ruta para obtener una categoria en especifico
        Route::get('category/{id}',[CategoriesController::class, 'show'])->name('category');
        //rutas para crear una categoria
        Route::get('create-category',[CategoriesController::class, 'create'])->name('create-category');
        //rutas para guardar una categoria
        Route::post('save-category',[CategoriesController::class, 'store'])->name('save-category');
        //rutas para editar la categoria
        Route::get('edit-category/{id}',[CategoriesController::class, 'edit'])->name('edit-category');
        //rutas para actualizar una categoria
        Route::post('update-category',[CategoriesController::class, 'update'])->name('update-category');
        //rutas para eliminar una categoria
        Route::post('delete-category',[CategoriesController::class, 'destroy'])->name('delete-category');

        /* rutas para el modulo de lugares */
        Route::get('places',[PlacesController::class, 'index'])->name('places');
        // ruta para obtener una categoria en especifico
        Route::get('place/{id}',[PlacesController::class, 'show'])->name('place');
        //rutas para crear una categoria
        Route::get('create-place',[PlacesController::class, 'create'])->name('create-place');
        //rutas para guardar una categoria
        Route::post('save-place',[PlacesController::class, 'store'])->name('save-place');
        //rutas para editar la categoria
        Route::get('edit-place/{id}',[PlacesController::class, 'edit'])->name('edit-place');
        //rutas para actualizar una categoria
        Route::post('update-place',[PlacesController::class, 'update'])->name('update-place');
        //rutas para eliminar una categoria
        Route::post('delete-place',[PlacesController::class, 'destroy'])->name('delete-place');
    });
});


