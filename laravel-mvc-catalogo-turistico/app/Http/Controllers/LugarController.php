<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlador de lugares turísticos (capa de control del patrón MVC).
 *
 * Recibe la petición HTTP desde el enrutador, solicita los datos
 * a través del modelo Lugar y devuelve una vista Blade con la
 * información lista para presentarse al usuario.
 */
class LugarController extends Controller
{
    /**
     * GET /lugares
     * Muestra el listado de lugares, con filtro opcional por categoría
     * enviado como parámetro de consulta (?categoria=Playas).
     */
    public function index(Request $request): View
    {
        // 1. El controlador lee los parámetros de la petición.
        $categoria = $request->query('categoria');

        // 2. Solicita los datos al modelo (nunca lee el JSON directamente).
        $lugares = Lugar::porCategoria($categoria);
        $categorias = Lugar::categorias();

        // 3. Entrega los datos a la vista y devuelve la respuesta.
        return view('lugares.index', compact('lugares', 'categorias', 'categoria'));
    }

    /**
     * GET /lugares/{id}
     * Muestra el detalle de un lugar específico.
     */
    public function show(int $id): View
    {
        $lugar = Lugar::buscar($id);

        // Si el id no existe en el JSON se responde con un error 404.
        abort_if($lugar === null, 404, 'El lugar solicitado no existe.');

        return view('lugares.show', compact('lugar'));
    }
}
