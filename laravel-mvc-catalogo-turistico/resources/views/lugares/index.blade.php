@extends('layouts.app')

@section('titulo', 'Lugares turísticos')

@section('contenido')

    <div class="text-center mb-4">
        <h1 class="fw-bold titulo-sv">Descubre El Salvador</h1>
        <p class="text-muted mb-0">
            Playas, volcanes, pueblos y sitios arqueológicos del pulgarcito de América.
        </p>
    </div>

    {{-- Filtro por categoría (se envía como parámetro GET) --}}
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
        <a href="{{ route('lugares.index') }}"
           class="btn btn-sm {{ empty($categoria) ? 'btn-primary' : 'btn-outline-primary' }}">
            Todas
        </a>
        @foreach ($categorias as $cat)
            <a href="{{ route('lugares.index', ['categoria' => $cat]) }}"
               class="btn btn-sm {{ $categoria === $cat ? 'btn-primary' : 'btn-outline-primary' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    <div class="row g-4">
        @forelse ($lugares as $lugar)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-lugar h-100 shadow-sm border-0">
                    <img src="{{ asset('img/lugares/' . $lugar['imagen']) }}"
                         class="card-img-top" alt="{{ $lugar['titulo'] }}">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-categoria">{{ $lugar['categoria'] }}</span>
                            <small class="text-muted">&#128205; {{ $lugar['departamento'] }}</small>
                        </div>
                        <h5 class="card-title mb-2">{{ $lugar['titulo'] }}</h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ \Illuminate\Support\Str::limit($lugar['descripcion'], 110) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-semibold">
                                @if ($lugar['precios']['entrada_nacional'] == 0)
                                    Entrada gratuita
                                @else
                                    Desde ${{ number_format($lugar['precios']['entrada_nacional'], 2) }}
                                @endif
                            </span>
                            <a href="{{ route('lugares.show', $lugar['id']) }}" class="btn btn-sm btn-primary">
                                Ver detalle
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center mb-0">
                    No hay lugares registrados para esta categoría.
                </div>
            </div>
        @endforelse
    </div>

@endsection
