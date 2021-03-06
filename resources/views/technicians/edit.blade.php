@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Modificar Proveedor</h2>
                </div>
                <div class="panel-body">
                    <form action="/technicians/{{$technician->id}}" method="POST">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="first_name">Nombre:</label>
                            <input type="text" name="first_name" class="form-control" value="{{$technician->first_name}}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido:</label>
                            <input type="text" name="last_name" class="form-control" value="{{$technician->last_name}}">
                        </div>
                        <div class="form-group">
                            <label for="cuit">CUIT:</label>
                            <input type="text" name="cuit" class="form-control" value="{{$technician->cuit}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefono:</label>
                            <input type="text" name="phone" class="form-control" value="{{$technician->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" value="{{$technician->email}}">
                        </div>
                        <div class="form-group">
                            <label for="address">Domicilio:</label>
                            <input type="text" name="address" class="form-control" value="{{$technician->address}}">
                        </div>
                        <input type="submit" class="btn btn-success pull-right" value="Guardar Cambios">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection