@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h1>Proveedor</h1>
            <h3>Nombre: {{ $provider->name }}</h3>
            <h3>CUIT: {{$provider->cuit}}</h3>
            <h3>Dirección: {{$provider->address}}</h3>
            <h3>Tel: {{$provider->phone}}</h3>
            <h3>Email: {{$provider->email}}</h3>
            <br>
            
        </div>
        <div class="col-md-4 hidden-sm">
            <h4>Técnicos Autorizados:</h4>
            <table class="table table-responsive table-hover table-condensed">
                <thead>
                <th>Nombre:</th>
                <th>Telefono:</th>
                </thead>
                <tbody>
                @foreach($provider->tecnicos as $tecnico)
                    <tr>
                        <td>{{$tecnico->last_name.", ".$tecnico->first_name}}</td>
                        <td>{{$tecnico->phone}}</td>
                        <td><a class="btn btn-xs btn-primary" href="{{route('tecnicos.show', $tecnico->id)}}">ver</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h5>Productos:</h5>
            <table class="table table-responsive table-hover">
                <thead>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </thead>
                <tbody>
                @foreach($provider->products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td><a class="btn btn-xs btn-success" href="{{route('products.show', $product->id)}}">ver</a></td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection