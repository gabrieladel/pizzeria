@extends('home')

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <br>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
    Nuevo
  </button>
  <br>
        <h3>Lista de Clientes</h3>
        <br>
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">cuil</th>
                        <th scope="col">acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cliente as $item)  
                    <tr class="">
                        <td scope="row">{{$item ->id}}</td>
                        <td>{{$item->cuil}}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @include('cliente.create')

    </div>
    <div class="col-md-2"></div>
</div>

@endsection