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

Route::get('/', function () {
    return view('welcome');
});

Route::get('mensaje', function () {
    $mensaje="hola";
    //$mensaje['mensaje']="bienvenido";
    $success=event(new App\Events\usuariosConctados($mensaje));
    return $success;
    //return $success;
    echo "Enviado";
});
