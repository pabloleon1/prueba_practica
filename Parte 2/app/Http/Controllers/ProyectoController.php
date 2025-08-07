<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    // Simulador de datos (esto normalmente estaría en la base de datos)
    private $proyectos = [
        1 => ['nombre' => 'Proyecto A', 'descripcion' => 'Descripción del Proyecto A'],
        2 => ['nombre' => 'Proyecto B', 'descripcion' => 'Descripción del Proyecto B'],
        3 => ['nombre' => 'Proyecto C', 'descripcion' => 'Descripción del Proyecto C'],
    ];

    public function index()
    {
        $proyectos = $this->proyectos;
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('proyectos.create');
    }

    public function store(Request $request)
    {
        // Simulamos guardar (solo mensaje)
        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado (simulado)');
    }

    public function show($id)
    {
        $proyecto = $this->proyectos[$id] ?? null;

        if (!$proyecto) {
            abort(404, 'Proyecto no encontrado');
        }

        return view('proyectos.show', compact('proyecto', 'id'));
    }

    public function edit($id)
    {
        $proyecto = $this->proyectos[$id] ?? null;

        if (!$proyecto) {
            abort(404, 'Proyecto no encontrado');
        }

        return view('proyectos.edit', compact('proyecto', 'id'));
    }

    public function update(Request $request, $id)
    {
        // Simulación de actualización
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado (simulado)');
    }

    public function destroy($id)
    {
        // Simulación de borrado
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado (simulado)');
    }
}
