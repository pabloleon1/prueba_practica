<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Inicializa las tareas en la sesión si no existen
    private function obtenerTareas()
    {
        if (!session()->has('tareas')) {
            session([
                'tareas' => [
                    ['id' => 1, 'titulo' => 'Diseño layout', 'descripcion' => 'Crear el diseño base del proyecto', 'proyecto_id' => 1, 'usuario_asignado' => 1, 'estado' => 'completada'],
                    ['id' => 2, 'titulo' => 'Crear rutas', 'descripcion' => 'Definir todas las rutas necesarias', 'proyecto_id' => 1, 'usuario_asignado' => 2, 'estado' => 'pendiente'],
                    ['id' => 3, 'titulo' => 'Validaciones', 'descripcion' => 'Implementar validaciones de formularios', 'proyecto_id' => 2, 'usuario_asignado' => 1, 'estado' => 'en progreso'],
                ]
            ]);
        } else {
            // Migrar tareas existentes que no tengan los nuevos campos
            $tareas = session('tareas');
            $tareasActualizadas = [];
            
            foreach ($tareas as $tarea) {
                // Asegurar que todas las tareas tengan los campos necesarios
                $tareaActualizada = [
                    'id' => $tarea['id'],
                    'titulo' => $tarea['titulo'],
                    'descripcion' => $tarea['descripcion'],
                    'proyecto_id' => $tarea['proyecto_id'] ?? 1, // Default al proyecto 1
                    'usuario_asignado' => $tarea['usuario_asignado'] ?? 1, // Default al usuario 1
                    'estado' => $tarea['estado'] ?? 'pendiente', // Default a pendiente
                ];
                $tareasActualizadas[] = $tareaActualizada;
            }
            
            session(['tareas' => $tareasActualizadas]);
        }

        return session('tareas');
    }

    // Obtener proyectos para el formulario
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

    // Obtener usuarios para el formulario
    private function obtenerUsuarios()
    {
        if (!session()->has('usuarios')) {
            session([
                'usuarios' => [
                    ['id' => 1, 'nombre' => 'Juan Pérez', 'email' => 'juan@correo.com'],
                    ['id' => 2, 'nombre' => 'Ana Gómez', 'email' => 'ana@correo.com'],
                ]
            ]);
        }

        return session('usuarios');
    }

    public function index()
    {
        $tareas = $this->obtenerTareas();
        $proyectos = $this->obtenerProyectos();
        $usuarios = $this->obtenerUsuarios();
        
        // Enriquecer tareas con información de proyecto y usuario
        foreach ($tareas as &$tarea) {
            // Asegurar que existan los campos necesarios
            $proyectoId = $tarea['proyecto_id'] ?? null;
            $usuarioAsignado = $tarea['usuario_asignado'] ?? null;
            
            $tarea['proyecto_nombre'] = $proyectoId && isset($proyectos[$proyectoId]) 
                ? $proyectos[$proyectoId]['nombre'] 
                : 'Sin proyecto';
            
            $usuario = $usuarioAsignado ? collect($usuarios)->firstWhere('id', $usuarioAsignado) : null;
            $tarea['usuario_nombre'] = $usuario ? $usuario['nombre'] : 'Sin asignar';
        }
        
        return view('tareas.index', compact('tareas', 'proyectos', 'usuarios'));
    }

    public function create()
    {
        $proyectos = $this->obtenerProyectos();
        $usuarios = $this->obtenerUsuarios();
        return view('tareas.create', compact('proyectos', 'usuarios'));
    }

    public function store(Request $request)
    {
        // Validación de la Parte 6
        $request->validate([
            'titulo' => 'required|min:3',
            'descripcion' => 'required|max:255',
            'proyecto_id' => 'required|integer',
            'usuario_asignado' => 'required|integer',
            'estado' => 'required|in:pendiente,en progreso,completada',
        ]);

        $tareas = $this->obtenerTareas();
        
        // Generar nuevo ID
        $nuevoId = count($tareas) > 0 ? max(array_column($tareas, 'id')) + 1 : 1;
        
        $nuevaTarea = [
            'id' => $nuevoId,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'proyecto_id' => $request->proyecto_id,
            'usuario_asignado' => $request->usuario_asignado,
            'estado' => $request->estado,
        ];

        $tareas[] = $nuevaTarea;
        session(['tareas' => $tareas]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente');
    }

    public function edit($id)
    {
        $tareas = $this->obtenerTareas();
        $tarea = collect($tareas)->firstWhere('id', $id);
        
        if (!$tarea) {
            abort(404, 'Tarea no encontrada');
        }
        
        $proyectos = $this->obtenerProyectos();
        $usuarios = $this->obtenerUsuarios();
        
        return view('tareas.edit', compact('tarea', 'proyectos', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        // Validación de la Parte 6
        $request->validate([
            'titulo' => 'required|min:3',
            'descripcion' => 'required|max:255',
            'proyecto_id' => 'required|integer',
            'usuario_asignado' => 'required|integer',
            'estado' => 'required|in:pendiente,en progreso,completada',
        ]);

        $tareas = $this->obtenerTareas();

        foreach ($tareas as &$tarea) {
            if ($tarea['id'] == $id) {
                $tarea['titulo'] = $request->titulo;
                $tarea['descripcion'] = $request->descripcion;
                $tarea['proyecto_id'] = $request->proyecto_id;
                $tarea['usuario_asignado'] = $request->usuario_asignado;
                $tarea['estado'] = $request->estado;
                break;
            }
        }

        session(['tareas' => $tareas]);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente');
    }

    public function tareasPorProyecto($proyecto_id)
    {
        $tareas = $this->obtenerTareas();
        $proyectos = $this->obtenerProyectos();
        $usuarios = $this->obtenerUsuarios();
        
        // Filtrar tareas por proyecto
        $tareasProyecto = collect($tareas)->where('proyecto_id', $proyecto_id)->values()->all();
        
        // Obtener información del proyecto
        $proyecto = $proyectos[$proyecto_id] ?? null;
        
        if (!$proyecto) {
            abort(404, 'Proyecto no encontrado');
        }
        
        // Enriquecer tareas con información de usuario
        foreach ($tareasProyecto as &$tarea) {
            $usuarioAsignado = $tarea['usuario_asignado'] ?? null;
            $usuario = $usuarioAsignado ? collect($usuarios)->firstWhere('id', $usuarioAsignado) : null;
            $tarea['usuario_nombre'] = $usuario ? $usuario['nombre'] : 'Sin asignar';
        }
        
        return view('tareas.por-proyecto', compact('tareasProyecto', 'proyecto', 'usuarios'));
    }
}
