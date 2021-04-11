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

//Rutas para select anidado de Pais, Estado, Ciudad
Route::get('select-anidado', [App\Http\Controllers\SelectAnidadoController::class, 'index']);
Route::post('api/obtener-estados', [App\Http\Controllers\SelectAnidadoController::class, 'obtenerEstados']);
Route::post('api/obtener-ciudades', [App\Http\Controllers\SelectAnidadoController::class, 'obtenerCiudades']);

//Redirecciono inicio a login de laravel
Route::get('/', function () {
    return redirect()->route('login');
});

//Rutas por defecto de AUTH
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas para gestion de usuarios
Route::resource('usuarios','App\Http\Controllers\UsuariosController');
Route::post('/usuarios/search', [App\Http\Controllers\UsuariosController::class, 'search'])->name('usuarios.search');

//Rutas para gestion de emails
Route::resource('emails','App\Http\Controllers\EmailsController');
Route::post('/emails/search', [App\Http\Controllers\EmailsController::class, 'search'])->name('emails.search');

//Rutas para api pública
Route::post('obtener-emails', [App\Http\Controllers\EmailsController::class, 'obtenerEmails']);
