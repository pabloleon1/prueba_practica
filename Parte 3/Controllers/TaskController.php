<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $tareas = [
        ['id' => 1, 'titulo' => 'Tarea 1', 'descripcion' => 'Descripción de la tarea 1'],
        ['id' => 2, 'titulo' => 'Tarea 2', 'descripcion' => 'Descripción de la tarea 2'],
    ];

    public function index()
    {
        $tareas = $this->tareas;
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        // Aquí normalmente guardarías en BD. Vamos a simular:
        return redirect()->route('tareas.index')->with('success', 'Tarea creada (simulada)');
    }

    public function edit($id)
    {
        // Simulamos buscar una tarea por ID
        $tarea = collect($this->tareas)->firstWhere('id', $id);
        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, $id)
    {
        // Simulación de actualización
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada (simulada)');
    }
}
