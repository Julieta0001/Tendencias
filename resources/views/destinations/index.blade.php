@extends('layouts.app')

@section('title', 'Lista de Destinos')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Catálogo de Destinos Turísticos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Destinos</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="icon fas fa-check"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado de Destinos Disponibles</h3>
                            <div class="card-tools">
                                <a href="{{ route('destinations.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Nuevo Destino
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- id="example1" activa la tabla interactiva de table.js -->
                            <table id="example1" class="table table-bordered table-striped table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Ubicación</th>
                                        <th>Dirección / Punto</th>
                                        <th class="text-right">Precio</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($destinations as $destination)
                                    <tr>
                                        <td>{{ $destination->id }}</td>
                                        <td><strong>{{ $destination->name }}</strong></td>
                                        <td>{{ $destination->city }}, {{ $destination->country }}</td>
                                        <td>{{ $destination->address ?? 'N/A' }}</td>
                                        <td class="text-right">
                                            <span class="badge badge-success" style="font-size: 0.9rem;">
                                                ${{ number_format($destination->price, 2) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="card-actions d-flex justify-content-center">
                                                <a href="{{ route('destinations.show', $destination->id) }}" class="btn btn-info btn-sm mr-1" title="Ver" aria-label="Ver">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-warning btn-sm mr-1" title="Editar" aria-label="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" aria-label="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar este destino?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection