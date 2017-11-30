@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Orden de Compra</div>
                <div class="panel-body">
                    <h3>Nro#:{{$order->id}}</h3>
                    <h3>Fecha: {{ $order->date_order }}</h3>
                    <h3>Proveedor: {{$order->provider->cuit}}</h3>
                    <h3>Producto: {{$order->product->name}}</h3>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-block btn-primary" href="{{route('qualificateBuyOrder',$order->id)}}">Calificar Orden de Compra</a>

                </div>
            </div>
    </div>


@endsection