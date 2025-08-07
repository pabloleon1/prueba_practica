Este archivo es el layout principal de la aplicación.

- Usa Bootstrap desde archivos locales en public/lib/
- Contiene la estructura base (HTML, navbar, @yield('content'), footer)
- El navbar ya tiene rutas hacia: dashboard, proyectos, tareas, usuarios
- Es totalmente reutilizable desde cualquier vista con @extends('layouts.app')

IMPORTANTE:
El archivo espera que el CSS esté en:
    public/lib/bootstrap.min.css
Y el JS en:
    public/lib/bootstrap.bundle.min.js
