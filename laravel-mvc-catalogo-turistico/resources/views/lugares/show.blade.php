@extends('layouts.app')

@section('titulo', $lugar['titulo'])

@section('contenido')

    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('lugares.index') }}">Lugares</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $lugar['titulo'] }}</li>
        </ol>
    </nav>

    <div class="card border-0 shadow-sm overflow-hidden">
        <img src="{{ asset('img/lugares/' . $lugar['imagen']) }}" class="w-100"
             alt="{{ $lugar['titulo'] }}" style="max-height: 340px; object-fit: cover;">

        <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge badge-categoria">{{ $lugar['categoria'] }}</span>
                <span class="badge text-bg-light border">&#128205; {{ $lugar['departamento'] }}</span>
            </div>

            <h1 class="fw-bold titulo-sv">{{ $lugar['titulo'] }}</h1>
            <p class="lead text-muted">{{ $lugar['descripcion'] }}</p>

            <div class="row g-4 mt-1">
                <div class="col-12 col-md-7">
                    <h5 class="fw-semibold mb-3">Información general</h5>
                    <table class="table table-sm align-middle mb-0">
                        <tbody>
                            <tr>
                                <th class="text-muted fw-normal" style="width: 38%;">Departamento</th>
                                <td>{{ $lugar['departamento'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Categoría</th>
                                <td>{{ $lugar['categoria'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Horario</th>
                                <td>{{ $lugar['horario'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Ubicación</th>
                                <td>{{ $lugar['ubicacion'] }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="fw-semibold mb-2 mt-4">Actividades</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($lugar['actividades'] as $actividad)
                            <span class="badge rounded-pill text-bg-light border">{{ $actividad }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 col-md-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body">
                            <h5 class="fw-semibold mb-3">Precios (USD)</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between border-bottom py-2">
                                    <span>Entrada nacionales</span>
                                    <span class="fw-semibold">
                                        {{ $lugar['precios']['entrada_nacional'] == 0
                                            ? 'Gratis'
                                            : '$' . number_format($lugar['precios']['entrada_nacional'], 2) }}
                                    </span>
                                </li>
                                <li class="d-flex justify-content-between border-bottom py-2">
                                    <span>Entrada extranjeros</span>
                                    <span class="fw-semibold">
                                        {{ $lugar['precios']['entrada_extranjero'] == 0
                                            ? 'Gratis'
                                            : '$' . number_format($lugar['precios']['entrada_extranjero'], 2) }}
                                    </span>
                                </li>
                                @if (! empty($lugar['precios']['parqueo']))
                                    <li class="d-flex justify-content-between py-2">
                                        <span>Parqueo</span>
                                        <span class="fw-semibold">
                                            ${{ number_format($lugar['precios']['parqueo'], 2) }}
                                        </span>
                                    </li>
                                @endif
                            </ul>
                            <small class="text-muted d-block mt-3">
                                Precios de referencia, sujetos a cambios.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="{{ route('contacto.create', ['lugar' => $lugar['id']]) }}" class="btn btn-primary">
                    Solicitar más información
                </a>
                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($lugar['titulo'] . ', El Salvador') }}"
                   target="_blank" rel="noopener" class="btn btn-outline-primary">
                    Ver en Google Maps
                </a>
                <a href="{{ route('lugares.index') }}" class="btn btn-link text-decoration-none">
                    Volver al listado
                </a>
            </div>
        </div>
    </div>

@endsection
