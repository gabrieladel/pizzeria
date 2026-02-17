@extends('layouts.app')

@section('contenido')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4><i class="fa fa-truck"></i> Datos de Envío y Confirmación</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('cart.process') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="cliente">Nombre Completo</label>
                                <input type="text" class="form-control" name="cliente" 
                                       value="{{ Auth::user()->name }}" readonly>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="telefono">Teléfono de Contacto</label>
                                <input type="text" class="form-control" name="telefono" placeholder="Ej: 12345678" required>
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="direccion">Dirección de Entrega</label>
                                <textarea class="form-control" name="direccion" rows="3" placeholder="Calle, número y departamento" required></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> Al hacer clic en "Finalizar", tu pedido se guardará en tu historial personal.
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa fa-check-circle"></i> Confirmar y Finalizar Compra
                            </button>
                            <a href="{{ route('cart.list') }}" class="btn btn-outline-secondary">Volver al carrito</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5>Resumen del Pedido</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($cartCollection as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->name }}</strong><br>
                                    <small class="text-muted">Cantidad: {{ $item->qty }}</small>
                                </div>
                                <span>${{ number_format($item->price * $item->qty, 2) }}</span>
                            </li>
                        @endforeach
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                            <span class="h5">TOTAL A PAGAR</span>
                            <span class="h5 text-danger">${{ \Cart::getTotal() }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
