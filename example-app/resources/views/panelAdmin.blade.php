@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
  
@stop

@section('content')


<div class="card shadow-sm">
    <div class="card-body text-center">
        <h2 class="fw-bold">
            <i class="fas fa-pizza-slice text-danger"></i>
            Bienvenido al panel administrativo
        </h2>
        <p class="text-muted">
            Gestioná pizzas, clientes, vendedores, pedidos y facturas desde este panel.
        </p>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Dashboard cargado');
</script>
@stop
