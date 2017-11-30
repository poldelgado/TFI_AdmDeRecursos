@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>Lista de Ordenes de Compra</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('buy_orders.create')  }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Nueva Orden</a>
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
                        <td>@if($order->buy_qualification->deliver == null && $order->buy_qualification->status == null && $order->buy_qualification->warranty == null)
                                Sin Calificar
                            @else
                                {{number_format((float)$order->buy_qualification->average, 1, '.', '')}}
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-xs btn-default" href="{{route('buy_orders.show',$order->id)}}">ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection