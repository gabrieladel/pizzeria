
@extends('layouts.app')

@section('contenido')

<h1 style="text-align: center; margin:10px">Contáctanos</h1>
<div class="row justify-content-center">
    <div class="col-12">
        <form id="form1" action="postular" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-6 mt-4">
                   
                    <div class="form-group my-3">
                        <label>Nombre: </label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <label>Apellido: </label>
                        <input type="text" id="txtApellido" name="txtApellido" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <label>Correo:</label>
                        <input type="text" id="txtCorreo" name="txtCorreo" class="form-control">
                    </div>
                    <div class="form-group my-6">
                        <label>Mensaje: </label>
                        <input type="text" id="txtMensaje" name="txtMensaje" class="form-control">
                    </div>
                    
                    <div class="text-center mb-5">

                        <button type="submit" class="btn btn-primary mt-4"><i class="far fa-paper-plane"></i> &nbsp; ENVIAR</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


        
            

   