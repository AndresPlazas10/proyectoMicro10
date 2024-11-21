<?php

use App\Http\Controllers\estudianteController;
use App\Http\Controllers\NotaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/estudiante', [EstudianteController::class, 'index']);

Route::get('/estudiante/{cod}', [EstudianteController::class, 'show']);

Route::post('/estudiante', [EstudianteController::class, 'store']);

Route::put('/estudiante/{cod}', [EstudianteController::class, 'update']);

Route::delete('/estudiante/{cod}', [EstudianteController::class, 'destroy']);

Route::get('/nota', [NotaController::class, 'index']);

Route::post('/nota', [NotaController::class, 'store']);
