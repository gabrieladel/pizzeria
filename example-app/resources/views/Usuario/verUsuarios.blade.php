@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

    <h2>Listado de Usuarios.</h2>
    @if (session("correcto"))
    <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
        var res=function(){
            var not=confirm("¿Estas seguro de eliminar?");
            return not;
        }
    </script>
    <!-- Modal de registro de datos-->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar nuevos Usuarios</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route("users.create")}}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nombre del users</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" name="txtname">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="exampleInputEmail1" class="form-label">Email del users</label>
                                                  <input type="number" class="form-control" id="exampleInputEmail"
                                                      aria-describedby="emailHelp" name="txtEmail">
                                              </div>
                                           
                                            <div class="mb-3">
                                              <label for="exampleInputEmail1" class="form-label">Rol del users</label>
                                              <input type="text" class="form-control" id="exampleInputEmail4"
                                                  aria-describedby="emailHelp" name="txtRoles">
                                          </div>
                                          
                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
    <div class="d-flex align-content-stretch flex-wrap" style="text-align: center;">
        <div class="p-5 table-responsive">
          <button class="btn btn-primary" data-bs-toggle="modal"
          data-bs-target="#modalRegistrar">Añadir usuarios</button>
          
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">nombre</th>
                        <th scope="col">email</th>
                        <th scope="col">roles</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($listado as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->roles }}</td>
                            <td><a href="" data-bs-toggle="modal"
                                    data-bs-target="#modalEditar{{ $item->id }}"class="btn btn-warning btn-sm"><i
                                        class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="{{route("users.delete", $item->id)}}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>

                            <!-- Modal de modificar datos-->
                            <div class="modal fade" id="modalEditar{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route("users.update")}}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">id del users</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="txtHelp" name="txtid" value="{{ $item->id }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nombre del users</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail2"
                                                        aria-describedby="txtHelp" name="txtnombre" value="{{ $item->name }}">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="exampleInputEmail1" class="form-label">Email del users</label>
                                                  <input type="text" class="form-control" id="exampleInputEmail3"
                                                      aria-describedby="txtHelp" name="txtEmail" value="{{ $item->email }}">
                                              </div>
                                              
                                            <div class="mb-3">
                                              <label for="exampleInputEmail1" class="form-label">Rol del users</label>
                                              <input type="text" class="form-control" id="exampleInputEmail5"
                                                  aria-describedby="txtHelp" name="txtroles" value="{{ $item->roles }}">
                                          </div>
                                         
                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
@stop
{{-- @extends('Usuario')
@section('users')
@stop --}}
{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@section('js')
@stop
