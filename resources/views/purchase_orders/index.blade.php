@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>Lista de Ordenes de Compra</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('purchase_orders.create')  }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Nueva Orden</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive">
                <thead>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Tiempo de Garantía</th>
                    <th>Proveedor</th>
                    <th>Calificación</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->date_order}}</td>
                        <td>{{$order->product->name}}</td>
                        <td>{{$order->warranty_void}}</td>
                        <td>{{$order->provider->name}}</td>
                        @if($order->purchase_qualification->deliver == null && $order->purchase_qualification->status == null && $order->purchase_qualification->warranty == null)
                        <td>
                                Sin Calificar
                        </td>
                        @else
                            <td>{{number_format((float)$order->purchase_qualification->average, 1, '.', '')}}</td>
                        @endif
                        <td>
                            <a class="btn btn-xs btn-default" href="{{route('purchase_orders.show',$order->id)}}">ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection