@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <p>Corrige los siguientes errores:</p>
                </div>
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{$message}}</li>
                    @endforeach
                </ul>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Nuevo Proveedor </h2>
                </div>
                <div class="panel-body">
                    <form action="/providers" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="cuit">CUIT:</label>
                            <input type="text" name="cuit" class="form-control" value="{{old('cuit')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefono:</label>
                            <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                        </div>
                        <div class="form-group">
                            <label for="address">Domicilio:</label>
                            <input type="text" name="address" class="form-control" value="{{old('address')}}">
                        </div>
                        <input type="submit" class="btn btn-success pull-right">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection