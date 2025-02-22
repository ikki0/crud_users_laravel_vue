<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\UserController;

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

// Ruta para obtener el usuario autenticado (puedes eliminar el middleware 'auth:sanctum' si no deseas autenticación)
// Route::get('/user', function (Request $request) {
//     return $request->user();
// });

// // Rutas para el controlador EstudianteController
Route::apiResource('v1/estudiantes', EstudianteController::class);

Route::apiResource('v1/usuario', UserController::class);
// // Ruta para mostrar un estudiante (GET /api/estudiantes/{id})
// Route::get('estudiantes/{id}', [EstudianteController::class, 'show']);

// // Rutas de recurso (opcional, si quieres todas las operaciones CRUD)
// Route::resource('estudiantes', EstudianteController::class);

// // Correcto en 5.10
// Route::get('estudiantes', [EstudianteController::class, 'index'])->name('cursos.index');