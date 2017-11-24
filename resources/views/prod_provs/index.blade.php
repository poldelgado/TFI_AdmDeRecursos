@extends('main')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>Productos</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('products.create')  }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Nuevo Producto</a>
        </div>
        <div class="col-md-12">

            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
@endsection