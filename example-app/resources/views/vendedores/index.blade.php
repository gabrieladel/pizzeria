@extends('adminlte::page')

@section('title', 'Vendedores')

@section('content_header')
    <h1>Lista de Vendedores (Administradores)</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Personal con rol administrativo</h3>
            <div class="card-tools">
                <a href="{{ route('vendedores.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nuevo Vendedor
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Legajo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendedores as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            {{-- Unión de Nombre y Apellido --}}
                            <td>
                                {{ $usuario->persona->nombre ?? 'S/N' }}
                                {{ $usuario->persona->apellido ?? '' }}
                            </td>
                            {{-- Teléfono correcto --}}
                            <td>{{ $usuario->persona->telefono ?? 'Sin Teléfono' }}</td>

                            <td>
                                @if ($usuario->persona && $usuario->persona->vendedor)
                                    <span class="badge badge-info">{{ $usuario->persona->vendedor->legajo }}</span>
                                @else
                                    <span class="badge badge-warning">Pendiente de Legajo</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="btn-group">
                                    {{-- Editar --}}
                                    <a href="{{ route('vendedores.edit', $usuario->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Eliminar Admin --}}
                                    <form action="{{ route('vendedores.destroy', $usuario->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este administrador? Esta acción no se puede deshacer.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>

                                    @if (!$usuario->persona || !$usuario->persona->vendedor)
                                        <a href="{{ route('vendedores.create', ['user_id' => $usuario->id]) }}"
                                            class="btn btn-success btn-sm ml-1">
                                            <i class="fas fa-plus"></i> Completar
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
