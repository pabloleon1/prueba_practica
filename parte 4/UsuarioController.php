<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Inicializa los usuarios en la sesión si no existen
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
        $usuarios = $this->obtenerUsuarios();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $usuarios = $this->obtenerUsuarios();

        $nuevo = [
            'id' => end($usuarios)['id'] + 1, // incrementa el ID
            'nombre' => $request->nombre,
            'email' => $request->email,
        ];

        $usuarios[] = $nuevo;
        session(['usuarios' => $usuarios]);

        return redirect()->route('usuarios.index')->with('mensaje', 'Usuario creado correctamente');
    }

    public function edit($id)
    {
        $usuario = collect($this->obtenerUsuarios())->firstWhere('id', $id);
        if (!$usuario) {
            abort(404);
        }

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuarios = $this->obtenerUsuarios();

        foreach ($usuarios as &$usuario) {
            if ($usuario['id'] == $id) {
                $usuario['nombre'] = $request->nombre;
                $usuario['email'] = $request->email;
                break;
            }
        }

        session(['usuarios' => $usuarios]);

        return redirect()->route('usuarios.index')->with('mensaje', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuarios = $this->obtenerUsuarios();

        $usuarios = array_filter($usuarios, fn($usuario) => $usuario['id'] != $id);
        session(['usuarios' => array_values($usuarios)]); // reindexar

        return redirect()->route('usuarios.index')->with('mensaje', 'Usuario eliminado correctamente');
    }
}
