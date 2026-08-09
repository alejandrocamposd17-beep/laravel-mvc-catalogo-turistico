<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * La raíz redirige al listado de lugares.
     */
    public function test_la_raiz_redirige_al_listado_de_lugares(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/lugares');
    }

    /**
     * El listado de lugares responde correctamente.
     */
    public function test_el_listado_de_lugares_responde_correctamente(): void
    {
        $response = $this->get('/lugares');

        $response->assertStatus(200);
    }
}
