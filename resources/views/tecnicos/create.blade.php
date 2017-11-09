@extends('layouts.app')
@section('content')
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
            <h2>Nuevo Técnico </h2>
        </div>
        <div class="panel-body">
            <form action="/tecnicos" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="first_name">Nombre:</label>
                    <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
                </div>
                <div class="form-group">
                    <label for="last_name">Apellido:</label>
                    <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">
                </div>
                <div class="form-group">
                    <label for="cuit">CUIT:</label>
                    <input type="text" name="cuit" class="form-control" value="{{old('cuit')}}">
                </div>
                <div class="form-group">
                    <label for="email">Teléfono:</label>
                    <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                </div>
                <div class="form-group">
                    <label for="phone">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
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