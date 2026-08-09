<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\LugarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
| Punto de entrada del enrutamiento (capa de presentación del patrón MVC).
| Cada ruta delega la petición al método correspondiente de un controlador.
*/

// Página de inicio: redirige al listado de lugares.
Route::get('/', fn () => redirect()->route('lugares.index'));

// Listado de lugares turísticos (con filtro opcional por categoría).
Route::get('/lugares', [LugarController::class, 'index'])->name('lugares.index');

// Detalle de un lugar específico.
Route::get('/lugares/{id}', [LugarController::class, 'show'])
    ->whereNumber('id')
    ->name('lugares.show');

// Formulario de contacto: mostrar (GET) y procesar (POST).
Route::get('/contacto', [ContactoController::class, 'create'])->name('contacto.create');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');
