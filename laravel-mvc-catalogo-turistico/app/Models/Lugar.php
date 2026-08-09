<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

/**
 * Modelo Lugar (capa de datos del patrón MVC).
 *
 * En este proyecto la fuente de datos no es una tabla de base de datos,
 * sino el archivo JSON ubicado en resources/data/lugares.json.
 * El modelo encapsula la lectura del archivo y todas las consultas,
 * de modo que los controladores nunca manipulan el archivo directamente.
 */
class Lugar
{
    /**
     * Ruta absoluta del archivo JSON que funciona como "tabla" de lugares.
     */
    protected static function archivo(): string
    {
        return resource_path('data/lugares.json');
    }

    /**
     * Devuelve todos los lugares como una colección de Laravel.
     */
    public static function todos(): Collection
    {
        return collect(File::json(self::archivo()));
    }

    /**
     * Busca un lugar por su id. Devuelve null si no existe.
     */
    public static function buscar(int $id): ?array
    {
        return self::todos()->firstWhere('id', $id);
    }

    /**
     * Lista de categorías únicas, ordenadas alfabéticamente.
     */
    public static function categorias(): Collection
    {
        return self::todos()
            ->pluck('categoria')
            ->unique()
            ->sort()
            ->values();
    }

    /**
     * Filtra los lugares por categoría. Si la categoría es null o vacía,
     * devuelve la colección completa.
     */
    public static function porCategoria(?string $categoria): Collection
    {
        $lugares = self::todos();

        if (! empty($categoria)) {
            $lugares = $lugares
                ->filter(fn (array $lugar) => $lugar['categoria'] === $categoria)
                ->values();
        }

        return $lugares;
    }
}
