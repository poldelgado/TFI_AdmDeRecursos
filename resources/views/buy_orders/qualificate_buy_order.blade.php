@extends('main')

@section('stylesheets')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Calificar Orden de Compra</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Orden</h2>
                </div>
                <div class="panel-body">
                    <h3>Fecha: {{$order->date_order}}</h3>
                    <h3>Proveedor:</h3>
                    <div><span><h4>CUIT: {{$order->provider->cuit}}</h4></span><span><h4>Nombre: {{$order->provider->name}}</h4></span></div>
                    <h3>Producto:</h3>
                    <div><span><h4>Nombre: {{$order->product->name}}</h4></span>
                    <h3>Calificar:</h3>
                    <form action="/buy_orders/qualificate/{{$order->buy_qualification->id}}" method="POST">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="delivery">Envio:</label>
                            <select class="form-control" name="delivery" id="delivery">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Estado del Producto:</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="warranty">Garantía:</label>
                            <select class="form-control" name="warranty" id="warranty">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success pull-right" value="Calificar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection

@section('scripts')


@endsection