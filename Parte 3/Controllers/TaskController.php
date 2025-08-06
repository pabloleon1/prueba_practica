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
        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente (simulado)');
    }

    public function edit($id)
    {
        $tarea = collect($this->tareas)->firstWhere('id', $id);
        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente (simulado)');
    }
}
