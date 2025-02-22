<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para el controlador EstudianteController

#Route::resource('estudiantes', EstudianteController::class);

// Ruta para mostrar un estudiante (GET /estudiantes/{id})
#Route::get('estudiantes/{id}', [EstudianteController::class, 'show'])->name('estudiantes.show');

// Ruta para listar estudiantes
#Route::get('estudiantes', [EstudianteController::class, 'index'])->name('estudiantes.index');
