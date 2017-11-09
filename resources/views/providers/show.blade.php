@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Proveedor</h1>
            <h3>Nombre: {{ $provider->name }}</h3>
            <h3>CUIT: {{$provider->cuit}}</h3>
            <h3>Dirección: {{$provider->address}}</h3>
            <h3>Tel: {{$provider->phone}}</h3>
            <h3>Email: {{$provider->email}}</h3>
        </div>
    </div>


@endsection