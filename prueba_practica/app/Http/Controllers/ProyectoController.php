<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    // Inicializa los proyectos en la sesión si no existen
    private function obtenerProyectos()
    {
        if (!session()->has('proyectos')) {
            session([
                'proyectos' => [
                    1 => ['id' => 1, 'nombre' => 'Proyecto A', 'descripcion' => 'Descripción del Proyecto A'],
                    2 => ['id' => 2, 'nombre' => 'Proyecto B', 'descripcion' => 'Descripción del Proyecto B'],
                    3 => ['id' => 3, 'nombre' => 'Proyecto C', 'descripcion' => 'Descripción del Proyecto C'],
                ]
            ]);
        }

        return session('proyectos');
    }

    public function index()
    {
        $proyectos = $this->obtenerProyectos();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('proyectos.create');
    }

    public function store(Request $request)
    {
        // Validación de la Parte 6
        $request->validate([
            'nombre' => 'required|min:3',
            'descripcion' => 'required|max:255',
        ]);

        $proyectos = $this->obtenerProyectos();
        
        // Generar nuevo ID
        $nuevoId = count($proyectos) > 0 ? max(array_keys($proyectos)) + 1 : 1;
        
        $nuevoProyecto = [
            'id' => $nuevoId,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ];

        $proyectos[$nuevoId] = $nuevoProyecto;
        session(['proyectos' => $proyectos]);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente');
    }

    public function show($id)
    {
        $proyectos = $this->obtenerProyectos();
        $proyecto = $proyectos[$id] ?? null;

        if (!$proyecto) {
            abort(404, 'Proyecto no encontrado');
        }

        return view('proyectos.show', compact('proyecto', 'id'));
    }

    public function edit($id)
    {
        $proyectos = $this->obtenerProyectos();
        $proyecto = $proyectos[$id] ?? null;

        if (!$proyecto) {
            abort(404, 'Proyecto no encontrado');
        }

        return view('proyectos.edit', compact('proyecto', 'id'));
    }

    public function update(Request $request, $id)
    {
        // Validación de la Parte 6
        $request->validate([
            'nombre' => 'required|min:3',
            'descripcion' => 'required|max:255',
        ]);

        $proyectos = $this->obtenerProyectos();

        if (isset($proyectos[$id])) {
            $proyectos[$id]['nombre'] = $request->nombre;
            $proyectos[$id]['descripcion'] = $request->descripcion;
            session(['proyectos' => $proyectos]);
        }

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente');
    }

    public function destroy($id)
    {
        $proyectos = $this->obtenerProyectos();

        if (isset($proyectos[$id])) {
            unset($proyectos[$id]);
            session(['proyectos' => $proyectos]);
        }

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente');
    }
}
