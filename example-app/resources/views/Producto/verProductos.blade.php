@extends('adminlte::page')

<!-- @section('content_header')

@stop -->

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
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Registrar nuevo Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- AGREGADO enctype PARA ARCHIVOS -->
                <form action="{{ route('productos-admin.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre del producto</label>
                        <input type="text" class="form-control" name="txtnombre" required>
                    </div>
                    <div class="mb-3">
    <label class="form-label">Categoría del producto</label>
    <!-- ELIMINA EL INPUT Y PEGA ESTO -->
    <select class="form-control" name="txtcategoria" required>
        <option value="" disabled selected>-- Seleccione una Categoría --</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
        @endforeach
    </select>
</div>

                    <div class="mb-3">
                        <label class="form-label">Imagen del producto</label>
                        <!-- CAMBIADO A TYPE FILE -->
                        <input type="file" class="form-control" name="txtimagen" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" class="form-control" name="txtdescripcion">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" name="txtprecio" required>
                    </div>
                    <div class="modal-footer">
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
                          <td>
    <img src="{{ $item->imagen ? asset('storage/' . $item->imagen) : asset('images/no-image.png') }}" 
         style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;" 
         alt="Imagen de {{ $item->nombre }}">
</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>${{ $item->precio }}</td>
                            <td><a href="" data-bs-toggle="modal"
                                    data-bs-target="#modalEditar{{ $item->id }}"class="btn btn-warning btn-sm"><i
                                        class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('productos-admin.destroy', $item->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return res()">
        <i class="fas fa-trash"></i>
    </button>
</form>

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
                                            <form action="{{ route('productos-admin.update', $item->id) }}" method="post">
    @csrf
    @method('PUT') 

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
    <label class="form-label">Categoría del producto</label>
    <select class="form-control" name="txtcategoria" required>
        <option value="" disabled selected>-- Seleccione una Categoría --</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
        @endforeach
    </select>
</div>

                                              <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Imagen del producto</label>
                                                <input type="text" class="form-control" id="exampleInputEmail4"
                                                    aria-describedby="txtHelp" name="txtimagen" value="{{ $item->imagen }}">
                                            </div>
                                            <div class="mb-3">
                                              <label for="exampleInputEmail1" class="form-label">Descripcion del producto</label>
                                              <input type="text" class="form-control" id="exampleInputEmail5"
                                                  aria-describedby="txtHelp" name="txtdescripcion" value="{{ $item->descripcion }}">
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
