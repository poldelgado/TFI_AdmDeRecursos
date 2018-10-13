@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Producto #{{$product->id}}</h1>
            <h3>Nombre: {{ $product->name }}</h3>
            <h4>Descripción: {{$product->description}}</h4>
        </div>
    </div>


@endsection