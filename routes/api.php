<?php

use App\Http\Controllers\API\PacienteController;
use App\Http\Controllers\API\AutenticarController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::get('pacientes', [PacienteController::class, 'index']);
Route::post('pacientes', [PacienteController::class, 'store']);
Route::get('pacientes/{paciente}', [PacienteController::class, 'show']);
Route::put('pacientes/{paciente}', [PacienteController::class, 'update']);
Route::delete('pacientes/{paciente}', [PacienteController::class, 'destroy']);*/

//Las rutas anteriores en una
//Route::apiResource('pacientes', PacienteController::class); Comentada para que no tengan acceso salvo que tenga un token
//misma ruta metida en el middleware de sanctum


//Rutas para el manejo de usuarios
Route::post('registro',[AutenticarController::class, 'registro']);
Route::post('acceso',[AutenticarController::class, 'acceso']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    //A esta ruta solo tienen accesos los usuarios que tengan el token asignado
    Route::post('cerrarsesion',[AutenticarController::class, 'cerrarSesion']);
    //Las rutas para el acceso a los pacientes no se van a poder utilizar  si no tienen un token
    Route::apiResource('pacientes', PacienteController::class);
});