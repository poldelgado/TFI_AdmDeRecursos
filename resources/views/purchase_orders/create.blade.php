@extends('main')

@section('content')
    <div class="row">
        <div class="col-md-8-col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Nueva Orden de Compra</h2>
                </div>
                <div class="panel-body">
                    <form action="/purchase_orders" method="POST" id="purchase_orders">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="date_order">Fecha:</label>
                            <input type="date" name="date_order" class="form-control" value="{{old('date_order')}}">
                        </div>
                        <div class="form-group">
                            <select name="product_id" id="product_id">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->id." - ".$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success pull-right" value="Crear">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection