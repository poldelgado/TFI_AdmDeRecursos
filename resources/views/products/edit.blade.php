@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Modificar Producto</h2>
                </div>
                <div class="panel-body">
                    <form action="/products/{{$product->id}}" method="POST">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control" value="{{$product->name}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea class="form-control" name="description" cols="40" rows="10" placeholder="Ingrese Texto Aquí">{{$product->description}}</textarea>
                        </div>
                        <input type="submit" class="btn btn-success pull-right" value="Guardar Cambios">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

