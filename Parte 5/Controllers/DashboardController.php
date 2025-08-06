<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $proyectos = [
            ['id' => 1, 'nombre' => 'Proyecto Laravel', 'miembros' => 4],
            ['id' => 2, 'nombre' => 'Proyecto Vue', 'miembros' => 3],
        ];

        $tareas = [
            ['id' => 1, 'titulo' => 'Diseño layout', 'estado' => 'completada'],
            ['id' => 2, 'titulo' => 'Crear rutas', 'estado' => 'pendiente'],
            ['id' => 3, 'titulo' => 'Validaciones', 'estado' => 'en progreso'],
        ];

        return view('dashboard', compact('proyectos', 'tareas'));
    }
}
