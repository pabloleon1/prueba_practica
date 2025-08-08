<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener datos de la sesión
        $proyectos = session('proyectos', []);
        $tareas = session('tareas', []);
        $usuarios = session('usuarios', []);

        // Si no hay datos en sesión, usar datos de ejemplo
        if (empty($proyectos)) {
            $proyectos = [
                1 => ['id' => 1, 'nombre' => 'Proyecto Laravel', 'descripcion' => 'Desarrollo de aplicación web', 'miembros' => 4],
                2 => ['id' => 2, 'nombre' => 'Proyecto Vue', 'descripcion' => 'Frontend con Vue.js', 'miembros' => 3],
            ];
        }

        if (empty($tareas)) {
            $tareas = [
                ['id' => 1, 'titulo' => 'Diseño layout', 'descripcion' => 'Crear el diseño base del proyecto', 'proyecto_id' => 1, 'usuario_asignado' => 1, 'estado' => 'completada'],
                ['id' => 2, 'titulo' => 'Crear rutas', 'descripcion' => 'Definir todas las rutas necesarias', 'proyecto_id' => 1, 'usuario_asignado' => 2, 'estado' => 'pendiente'],
                ['id' => 3, 'titulo' => 'Validaciones', 'descripcion' => 'Implementar validaciones de formularios', 'proyecto_id' => 2, 'usuario_asignado' => 1, 'estado' => 'en progreso'],
            ];
        }

        if (empty($usuarios)) {
            $usuarios = [
                ['id' => 1, 'nombre' => 'Juan Pérez', 'email' => 'juan@correo.com'],
                ['id' => 2, 'nombre' => 'Ana Gómez', 'email' => 'ana@correo.com'],
            ];
        }

        // Calcular estadísticas
        $totalProyectos = count($proyectos);
        $totalTareas = count($tareas);
        $totalUsuarios = count($usuarios);

        // Contar tareas por estado
        $tareasPendientes = collect($tareas)->where('estado', 'pendiente')->count();
        $tareasEnProgreso = collect($tareas)->where('estado', 'en progreso')->count();
        $tareasCompletadas = collect($tareas)->where('estado', 'completada')->count();

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

        return view('dashboard', compact(
            'proyectos', 
            'tareas', 
            'usuarios',
            'totalProyectos',
            'totalTareas', 
            'totalUsuarios',
            'tareasPendientes',
            'tareasEnProgreso',
            'tareasCompletadas'
        ));
    }

    public function reset()
    {
        // Limpiar datos de sesión
        session()->forget(['proyectos', 'tareas', 'usuarios']);
        
        return redirect()->route('dashboard')->with('success', 'Datos reseteados correctamente. La aplicación volvió al estado inicial.');
    }
}
