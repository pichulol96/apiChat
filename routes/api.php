<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//ruta de registro de usuario
Route::post('registrarUsuario', [App\Http\Controllers\usuario::class, 'registro_usuario'])->name('registrarUsuario');

//esta ruta se activa cuando el usuario activa su cuenta desde su correro
Route::get('/ativarUsuario/{codigo}', [App\Http\Controllers\usuario::class, 'activar_usuario'])->name('/ativarUsuario');

//ruta de login
Route::post('loginUsuario', [App\Http\Controllers\usuario::class, 'login_usuario'])->name('loginUsuario');

//ruta cerrar sesion
Route::post('logautUsuario', [App\Http\Controllers\usuario::class, 'logaut_usuario'])->name('logautUsuario');

//se obtienen todos ls usuarios conectados
Route::get('getUsers', [App\Http\Controllers\usuario::class, 'get_users'])->name('getUsers');

//ruta Cambiar foto de perfil
Route::post('cambiarFoto', [App\Http\Controllers\usuario::class, 'cambiar_foto'])->name('cambiarFoto');


//ruta de chat entre usuarios
Route::post('getChat', [App\Http\Controllers\chat::class, 'get_chat'])->name('getChat');
Route::post('insertChat', [App\Http\Controllers\chat::class, 'insertar_chat'])->name('insertChat');
