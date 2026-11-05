@extends('layouts.app')

@section('title', 'Perfil del Viajero')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perfil del Viajero</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('travelers.index') }}">Viajeros</a></li>
                        <li class="breadcrumb-item active">Detalle</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="icon fas fa-check"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="icon fas fa-ban"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <!-- Columna Izquierda: Tarjeta de Perfil -->
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile text-center">
                            <div class="text-center mb-3">
                                @if($traveler->photo && file_exists(public_path('uploads/travelers/' . $traveler->photo)))
                                    <img class="profile-user-img img-fluid img-circle img-thumbnail"
                                         src="{{ asset('uploads/travelers/' . $traveler->photo) }}"
                                         alt="Foto de {{ $traveler->name }}"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img class="profile-user-img img-fluid img-circle img-thumbnail"
                                         src="https://ui-avatars.com/api/?name={{ urlencode($traveler->name) }}&size=150&color=7F9CF5&background=EBF4FF"
                                         alt="Foto de {{ $traveler->name }}"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                            </div>

                            <h3 class="profile-username text-center font-weight-bold">{{ $traveler->name }}</h3>
                            <p class="text-muted text-center">Viajero Registrado</p>

                            <ul class="list-group list-group-unbordered mb-3 text-left">
                                <li class="list-group-item">
                                    <b><i class="fas fa-id-card text-primary mr-1"></i> Documento:</b>
                                    <span class="float-right text-dark">{{ $traveler->document }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b><i class="fas fa-envelope text-primary mr-1"></i> Correo:</b>
                                    <span class="float-right text-dark">{{ $traveler->email }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b><i class="fas fa-phone text-primary mr-1"></i> Teléfono:</b>
                                    <span class="float-right text-dark">{{ $traveler->phone ?? 'No especificado' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b><i class="fas fa-map-marker-alt text-primary mr-1"></i> Dirección:</b>
                                    <span class="float-right text-dark">{{ $traveler->address ?? 'No especificada' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b><i class="fas fa-plane text-primary mr-1"></i> Inscripciones:</b>
                                    <span class="float-right badge badge-info">
                                        {{ $traveler->traveler_destination ? $traveler->traveler_destination->count() : 0 }} Destinos
                                    </span>
                                </li>
                            </ul>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('travelers.index') }}" class="btn btn-secondary btn-block mr-1">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <a href="{{ route('travelers.edit', $traveler->id) }}" class="btn btn-warning btn-block ml-1 mt-0">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha: Detalle de Inscripciones e Inscripción Rápida -->
                <div class="col-md-8">
                    <!-- Tarjeta para Inscribir a Nuevo Destino -->
                    <div class="card card-success card-outline mb-3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i> Inscribir a un Nuevo Destino</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('travelers.inscribir', $traveler->id) }}" method="POST">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-md-8 mb-2">
                                        <label for="destination_id">Seleccionar Destino Turístico:</label>
                                        <select name="destination_id" id="destination_id" class="form-control" required>
                                            <option value="" disabled selected>-- Elija un destino --</option>
                                            @foreach(\App\Models\Destination::orderBy('name')->get() as $dest)
                                                <option value="{{ $dest->id }}">
                                                    {{ $dest->name }} ({{ $dest->city }}, {{ $dest->country }}) - ${{ number_format($dest->price, 2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fas fa-check-circle"></i> Confirmar Inscripción
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tarjeta de Historial de Destinos -->
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <h3 class="card-title p-1"><i class="fas fa-suitcase-rolling mr-2"></i> Destinos e Itinerarios Registrados</h3>
                        </div>
                        <div class="card-body">
                            @if($traveler->traveler_destination && $traveler->traveler_destination->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Destino</th>
                                                <th>Ubicación</th>
                                                <th>Fecha de Registro</th>
                                                <th class="text-right">Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($traveler->traveler_destination as $registro)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $registro->destination->name ?? 'N/A' }}</strong>
                                                    </td>
                                                    <td>
                                                        {{ $registro->destination->city ?? '' }}, {{ $registro->destination->country ?? '' }}
                                                    </td>
                                                    <td>
                                                        <i class="far fa-calendar-alt text-muted mr-1"></i>
                                                        {{ \Carbon\Carbon::parse($registro->registration_date)->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td class="text-right">
                                                        <span class="badge badge-success" style="font-size: 0.9rem;">
                                                            ${{ number_format($registro->destination->price ?? 0, 2) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-plane-slash fa-3x text-muted mb-3"></i>
                                    <p class="text-muted lead">Este viajero aún no tiene ningún destino inscrito.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection