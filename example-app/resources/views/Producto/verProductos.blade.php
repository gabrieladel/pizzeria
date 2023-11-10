@extends('adminlte::page')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@section('title', '#Pizzas')

@section('content_header')

@stop

@section('content')

    <h2>Lista de Productos.</h2>
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar nuevos Productos</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route("producto.create")}}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nombre del producto</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" name="txtnombre">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="exampleInputEmail1" class="form-label">Categoria del producto</label>
                                                  <input type="number" class="form-control" id="exampleInputEmail2"
                                                      aria-describedby="emailHelp" name="txtcategoria">
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Imagen del producto</label>
                                                <input type="text" class="form-control" id="exampleInputEmail3"
                                                    aria-describedby="emailHelp" name="txtimagen">
                                            </div>
                                            <div class="mb-3">
                                              <label for="exampleInputEmail1" class="form-label">Descripcion del producto</label>
                                              <input type="text" class="form-control" id="exampleInputEmail4"
                                                  aria-describedby="emailHelp" name="txtdescripcion">
                                          </div>
                                          <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Precio del producto</label>
                                            <input type="number" class="form-control" id="exampleInputEmail5"
                                                aria-describedby="emailHelp" name="txtprecio">
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
          data-bs-target="#modalRegistrar">Añadir producto</button>
          
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">nombre</th>
                        <th scope="col">categoria</th>
                        <th scope="col">imagen</th>
                        <th scope="col">descipcion</th>
                        <th scope="col">precio</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($listado as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->categoria_id }}</td>
                            <td><img src="{{ $item->imagen }}" style="width: 4rem; height:2rem;"alt=""
                                    srcset=""></td>
                            <td>{{ $item->descripción }}</td>
                            <td>${{ $item->precio }}</td>
                            <td><a href="" data-bs-toggle="modal"
                                    data-bs-target="#modalEditar{{ $item->id }}"class="btn btn-warning btn-sm"><i
                                        class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="{{route("producto.delete", $item->id)}}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
                                            <form action="{{route("producto.update")}}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">id del producto</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="txtHelp" name="txtid" value="{{ $item->id }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Nombre del producto</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail2"
                                                        aria-describedby="txtHelp" name="txtnombre" value="{{ $item->nombre }}">
                                                </div>
                                                <div class="mb-3">
                                                  <label for="exampleInputEmail1" class="form-label">Categoria del producto</label>
                                                  <input type="text" class="form-control" id="exampleInputEmail3"
                                                      aria-describedby="txtHelp" name="txtcategoria" value="{{ $item->categoria_id }}">
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Imagen del producto</label>
                                                <input type="text" class="form-control" id="exampleInputEmail4"
                                                    aria-describedby="txtHelp" name="txtimagen" value="{{ $item->imagen }}">
                                            </div>
                                            <div class="mb-3">
                                              <label for="exampleInputEmail1" class="form-label">Descripcion del producto</label>
                                              <input type="text" class="form-control" id="exampleInputEmail5"
                                                  aria-describedby="txtHelp" name="txtdescripcion" value="{{ $item->descripción }}">
                                          </div>
                                          <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Precio del producto</label>
                                            <input type="text" class="form-control" id="exampleInputEmail6"
                                                aria-describedby="txtHelp" name="txtprecio" value="{{ $item->precio }}">
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
{{-- @extends('Producto')
@section('producto')
@stop --}}
{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@section('js')
    <script>
        console.log('Hi!');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@stop
