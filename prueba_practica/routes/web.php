<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/reset', [DashboardController::class, 'reset'])->name('dashboard.reset');

// Proyectos
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
Route::get('/proyectos/{id}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');

// Tareas
Route::prefix('tareas')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tareas.index');
    Route::get('/crear', [TaskController::class, 'create'])->name('tareas.create');
    Route::post('/', [TaskController::class, 'store'])->name('tareas.store');
    Route::get('/{id}/editar', [TaskController::class, 'edit'])->name('tareas.edit');
    Route::put('/{id}', [TaskController::class, 'update'])->name('tareas.update');
});

// Tareas por proyecto
Route::get('/proyectos/{proyecto_id}/tareas', [TaskController::class, 'tareasPorProyecto'])->name('proyectos.tareas');

// Usuarios
Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/crear', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/guardar', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/{id}/editar', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});
