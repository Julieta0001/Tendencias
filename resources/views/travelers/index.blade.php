@extends('layouts.app')

@section('title', 'Lista de Viajeros')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Viajeros</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Viajeros</li>
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
                            <h3 class="card-title">Registros de Viajeros</h3>
                            <div class="card-tools">
                                <a href="{{ route('travelers.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Nuevo Viajero
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- id="example1" activa el script table.js enviado por el profesor -->
                            <table id="example1" class="table table-bordered table-striped table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="text-center">Foto</th>
                                        <th>Documento</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($travelers as $traveler)
                                    <tr>
                                        <td>{{ $traveler->id }}</td>
                                        <td class="text-center">
                                            @if($traveler->photo && file_exists(public_path('uploads/travelers/' . $traveler->photo)))
                                                <img src="{{ asset('uploads/travelers/' . $traveler->photo) }}" alt="{{ $traveler->name }}" class="img-circle elevation-2" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($traveler->name) }}&color=1A66E6&background=E6F0FF" alt="{{ $traveler->name }}" class="img-circle elevation-1" style="width: 40px; height: 40px;">
                                            @endif
                                        </td>
                                        <td>{{ $traveler->document }}</td>
                                        <td><strong>{{ $traveler->name }}</strong></td>
                                        <td>{{ $traveler->email }}</td>
                                        <td>{{ $traveler->phone ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <div class="card-actions d-flex justify-content-center">
                                                <a href="{{ route('travelers.show', $traveler->id) }}" class="btn btn-info btn-sm mr-1" title="Ver" aria-label="Ver">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('travelers.edit', $traveler->id) }}" class="btn btn-warning btn-sm mr-1" title="Editar" aria-label="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('travelers.destroy', $traveler->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" aria-label="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar este viajero?')">
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