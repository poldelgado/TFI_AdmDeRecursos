@extends('main')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Asignar Producto a Proveedor</h2>
                </div>
                <div class="panel-body">
                    <form action="/prod_provs" method="POST" id="prod_provs">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="products">Producto:</label>
                            <select class="form-control" name="product_id" id="products">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{"Cod: ".$product->id." - Nombre: ".$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="providers">Proveedor:</label>
                            <select class="form-control" name="provider_id" id="providers">
                                @foreach($providers as $provider)
                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio:</label>
                            <input class="form-control" name="price" type="text" placeholder="$00.00">
                        </div>
                        <div class="form-group">
                            <label for="warranty_months">Tiempo de garantía (en meses):</label>
                            <input class="form-control" name="warranty_months" type="text">
                        </div>

                        <input type="submit" class="btn btn-success pull-right" value="Crear">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Nuevo Producto
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <form action="/products" method="POST" id="products">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Nombre:</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea class="form-control" name="description" cols="40" rows="10" placeholder="Ingrese Texto Aquí"></textarea>

                                </div>
                                <input type="submit" class="btn btn-success pull-right" value="Crear">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Nuevo Proveedor
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <form action="/providers" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Nombre:</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="cuit">CUIT:</label>
                                    <input type="text" name="cuit" class="form-control" value="{{old('cuit')}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Telefono:</label>
                                    <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Domicilio:</label>
                                    <input type="text" name="address" class="form-control" value="{{old('address')}}">
                                </div>
                                <input type="submit" value="Crear" class="btn btn-success pull-right">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection