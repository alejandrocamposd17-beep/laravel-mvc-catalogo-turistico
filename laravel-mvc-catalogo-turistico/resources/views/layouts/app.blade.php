<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Inicio') | Turismo SV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --azul-sv: #0f4c81;      /* Azul profundo, inspirado en la bandera y el Pacífico */
            --azul-hover: #0a3a63;
            --arena: #f6f4ef;        /* Fondo cálido tipo arena */
        }
        body { background-color: var(--arena); }
        .navbar-sv { background-color: var(--azul-sv); }
        .titulo-sv { color: var(--azul-sv); }
        .btn-primary {
            background-color: var(--azul-sv);
            border-color: var(--azul-sv);
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--azul-hover);
            border-color: var(--azul-hover);
        }
        .btn-outline-primary { color: var(--azul-sv); border-color: var(--azul-sv); }
        .btn-outline-primary:hover {
            background-color: var(--azul-sv);
            border-color: var(--azul-sv);
        }
        .badge-categoria { background-color: var(--azul-sv); }
        .card-lugar { transition: transform .15s ease, box-shadow .15s ease; }
        .card-lugar:hover {
            transform: translateY(-4px);
            box-shadow: 0 .5rem 1rem rgba(15, 76, 129, .18) !important;
        }
        footer { background-color: var(--azul-sv); }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-sv shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('lugares.index') }}">&#127755; Turismo SV</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
                    aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lugares.*') ? 'active fw-semibold' : '' }}"
                           href="{{ route('lugares.index') }}">Lugares</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto.*') ? 'active fw-semibold' : '' }}"
                           href="{{ route('contacto.create') }}">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        @yield('contenido')
    </main>

    <footer class="text-white text-center py-3 mt-auto">
        <small>
            Catálogo turístico de El Salvador.
            Elaborado por Alejandro Campos.
        </small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
