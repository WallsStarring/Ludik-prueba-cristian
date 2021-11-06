<?php

use App\Models\Usuario;
use Illuminate\Http\Request;
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

Route::get('/pregunta1', function () {
    //Desarrollar el método para obtener un listado de 10 usuarios que jugaron más veces que tengan el parámetro Aceptó en 1 o 0 (el método debe recibir la variable acepto 1 o 0).
    /* @var Usuario $user */
    $user = Usuario::withCount('partidas')->where('Acepto', '=', true)->orderByDesc('partidas_count')->limit(10)->get();
    return $user;
});
Route::get('/pregunta2/{fecha1}/{fecha2}/{letra?}', function (Request $request, $fecha1, $fecha2, $letra = null) {
    //Desarrollar el método para obtener el porcentaje de usuarios que se registraron entre una fecha y otra cuyo nombre empiece con una letra (el método debe recibir fecha1, fecha2 y la letra)
    /* @var Usuario $user */
    $count = Usuario::whereDate('fechaRegistro', '<=', $fecha1)
        ->whereDate('fechaRegistro', '>=', $fecha2)->where('Nombre', 'LIKE', $letra . '%')->count();
    // return Usuario::count() * $user / 100;
    return (round(Usuario::count() / ($count * 100), 3)*100) . '%';
});
Route::get('/pregunta3/{idDisfraz}', function ($idDisfraz) {
    //Desarrollar el método para obtener los 10 primeros usuarios que ganaron más puntaje filtrando por idDisfraz (el método debe recibir el idDisfraz).

    $user = Usuario::withSum('partidas', 'puntos')->where('idDisfraz', $idDisfraz)->orderByDesc('partidas_sum_puntos')->limit(10)->get();
    return $user;
});
Route::get('/pregunta1/{name}', function ($name) {
    //Desarrollar un método para obtener el promedio de tiempo de juego por usuario.
    $user = Usuario::where('Nombre', $name)->first();
    $user->avgPartidas();
    return $user->avgPartidas();
});

