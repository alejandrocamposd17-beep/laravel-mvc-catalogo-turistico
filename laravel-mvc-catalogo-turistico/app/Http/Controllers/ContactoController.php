<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Controlador del formulario de contacto.
 *
 * Demuestra el ciclo completo de una petición POST:
 * validación de los datos, persistencia en un archivo JSON
 * y redirección con mensaje de confirmación (patrón Post-Redirect-Get).
 */
class ContactoController extends Controller
{
    /**
     * GET /contacto
     * Muestra el formulario. Puede llegar un lugar preseleccionado
     * desde la vista de detalle (?lugar=id).
     */
    public function create(Request $request): View
    {
        $lugares = Lugar::todos();
        $lugarSeleccionado = (int) $request->query('lugar', 0);

        return view('contacto.create', compact('lugares', 'lugarSeleccionado'));
    }

    /**
     * POST /contacto
     * Valida el formulario y guarda la solicitud en
     * storage/app/private/contactos.json.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validación del lado del servidor con mensajes en español.
        $datos = $request->validate(
            [
                'nombre' => ['required', 'string', 'max:100'],
                'correo' => ['required', 'email', 'max:100'],
                'lugar_id' => ['nullable', 'integer'],
                'mensaje' => ['required', 'string', 'max:500'],
            ],
            [
                'nombre.required' => 'El nombre es obligatorio.',
                'correo.required' => 'El correo es obligatorio.',
                'correo.email' => 'Debes ingresar un correo válido.',
                'mensaje.required' => 'Escribe un mensaje con tu consulta.',
                'mensaje.max' => 'El mensaje no debe superar los 500 caracteres.',
            ]
        );

        // 2. Se enriquece la solicitud con el nombre del lugar y la fecha.
        $lugar = ! empty($datos['lugar_id']) ? Lugar::buscar((int) $datos['lugar_id']) : null;
        $datos['lugar'] = $lugar['titulo'] ?? 'Consulta general';
        $datos['fecha'] = now()->format('Y-m-d H:i:s');

        // 3. Lectura y escritura del archivo JSON de contactos.
        $archivo = 'contactos.json';

        $contactos = Storage::exists($archivo)
            ? json_decode(Storage::get($archivo), true)
            : [];

        $contactos[] = $datos;

        Storage::put(
            $archivo,
            json_encode($contactos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        // 4. Redirección con mensaje flash de éxito.
        return redirect()
            ->route('contacto.create')
            ->with('exito', 'Hemos recibido tu solicitud. Muy pronto te enviaremos más información sobre el destino.');
    }
}
