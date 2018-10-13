@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4><strong>Orden de Compra</strong></h4></div>
                <div class="panel-body">
                    <h3>Nro#: {{$order->id}}</h3>
                    <h3>Fecha: {{ $order->date_order }}</h3>
                    <h3>Proveedor:</h3>
                    <div class="qual-product">
                        <h4>Nombre: <strong>{{$order->provider->name}}</strong></h4>
                        <h4>CUIT: <strong>{{$order->provider->cuit}}</strong></h4>
                        <a href="{{route('providers.show',$order->provider->id)}}" class="btn btn-primary">Ver Proveedor</a>

                    </div>
                    <h3>Producto: {{$order->product->name}}</h3>
                    <h3>Calificaciones:</h3>
                    @if($order->buy_qualification->deliver == null && $order->buy_qualification->status == null && $order->buy_qualification->warranty == null)
                        <h4 class="qual-product">Orden sin calificar</h4>
                    @else
                        <div class="qual-product">
                            <h4>Envio: {{$order->buy_qualification->delivery}}</h4>
                            <h4>Estado del Producto: {{$order->buy_qualification->status}}</h4>
                            <h4>Garantía: {{$order->buy_qualification->warranty}}</h4>
                            <h4>Calificación Promedio: <strong>{{number_format((float)$order->buy_qualification->average, 1, '.', '')}}</strong></h4>
                        </div>
                    @endif
                </div>
                <div class="panel-footer">
                    @if($order->buy_qualification->deliver == null && $order->buy_qualification->status == null && $order->buy_qualification->warranty == null)
                        <a class="btn btn-block btn-primary" href="{{route('qualificatePurchaseOrder',$order->id)}}">Calificar Orden de Compra</a>
                    @endif
                </div>
            </div>
    </div>


@endsection