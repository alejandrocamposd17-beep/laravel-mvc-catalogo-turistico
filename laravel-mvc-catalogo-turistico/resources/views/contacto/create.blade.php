@extends('layouts.app')

@section('titulo', 'Contacto')

@section('contenido')

    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h1 class="h3 fw-bold mb-1 titulo-sv">Solicita más información</h1>
                    <p class="text-muted mb-4">
                        Completa el formulario y te contactaremos con todos los detalles del destino que te interesa.
                    </p>

                    @if (session('exito'))
                        <div class="alert alert-success" role="alert">
                            {{ session('exito') }}
                        </div>
                    @endif

                    <form action="{{ route('contacto.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre completo *</label>
                            <input type="text" name="nombre" id="nombre"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   value="{{ old('nombre') }}" placeholder="Ej. María Pérez">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico *</label>
                            <input type="email" name="correo" id="correo"
                                   class="form-control @error('correo') is-invalid @enderror"
                                   value="{{ old('correo') }}" placeholder="nombre@correo.com">
                            @error('correo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lugar_id" class="form-label">Lugar de interés</label>
                            <select name="lugar_id" id="lugar_id" class="form-select">
                                <option value="0">Consulta general</option>
                                @foreach ($lugares as $lugar)
                                    <option value="{{ $lugar['id'] }}"
                                        @selected(old('lugar_id', $lugarSeleccionado) == $lugar['id'])>
                                        {{ $lugar['titulo'] }} ({{ $lugar['departamento'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="mensaje" class="form-label">Mensaje *</label>
                            <textarea name="mensaje" id="mensaje" rows="4"
                                      class="form-control @error('mensaje') is-invalid @enderror"
                                      placeholder="Cuéntanos qué información necesitas">{{ old('mensaje') }}</textarea>
                            @error('mensaje')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">Enviar solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
