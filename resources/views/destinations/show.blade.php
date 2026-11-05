@extends('layouts.app')

@section('title', 'Detalle del Destino')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detalle del Destino</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('destinations.index') }}">Destinos</a></li>
                        <li class="breadcrumb-item active">Detalle</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-map-marked-alt mb-1"></i> {{ $destination->name }}</h3>
                        </div>
                        <div class="card-body">
                            <p><strong><i class="fas fa-globe-americas"></i> Ubicación:</strong> {{ $destination->city }}, {{ $destination->country }}</p>
                            <p><strong><i class="fas fa-map-pin"></i> Punto / Dirección:</strong> {{ $destination->address ?? 'No especificado' }}</p>
                            <p><strong><i class="fas fa-tag"></i> Precio por Persona:</strong> <span class="badge badge-success" style="font-size: 1rem;">${{ number_format($destination->price, 2) }}</span></p>
                            <hr>
                            <p><strong><i class="fas fa-align-left"></i> Descripción del Tour:</strong></p>
                            <p class="text-muted">{{ $destination->description ?? 'Sin descripción disponible.' }}</p>

                            <hr>
                            <h4><i class="fas fa-users"></i> Viajeros Inscritos</h4>
                            @if($destination->travelers && $destination->travelers->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($destination->travelers as $traveler)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-user-circle"></i> {{ $traveler->name }} (Doc: {{ $traveler->document }})</span>
                                            <span class="badge badge-secondary">{{ $traveler->email }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No hay viajeros inscritos en este destino todavía.</p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('destinations.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver a la Lista</a>
                            <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar Destino</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user-plus mb-1"></i> Inscribir Viajero</h3>
                        </div>
                        <form action="{{ route('destinations.inscribir', $destination->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="traveler_id">Seleccionar Viajero</label>
                                    <select name="traveler_id" class="form-control" id="traveler_id" required>
                                        <option value="">-- Seleccione un viajero --</option>
                                        @foreach(\App\Models\Traveler::all() as $traveler)
                                            <option value="{{ $traveler->id }}">{{ $traveler->name }} ({{ $traveler->document }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check-circle"></i> Confirmar Inscripción</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection