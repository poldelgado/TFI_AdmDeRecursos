@extends('main')

@section('stylesheets')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Nueva Orden de Compra</h2>
                </div>
                <div class="panel-body">
                    <form action="/buy_orders" method="POST" id="buy_orders">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="date_order">Nombre:</label>
                            <input type="date" name="date_order" class="form-control" value="{{old('date_order')}}">
                        </div>
                        <div class="form-group">
                            <label for="providers">Elegir Proveedor:</label>
                            <select class="form-control" name="providers" id="providers">
                                <option value="0" disabled="true" selected="true">---Proveedores---</option>
                                @foreach($providers as $provider)
                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="products">Elegir Producto</label>
                            <select class="form-control"  name="products" id="products">
                                <option value="0" disabled="true" selected="true">---Productos---</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="warranty_void">Tiempo de Garantia:</label>
                            <input type="text" name="warranty_void" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="total">Total:</label>
                            <input type="text" name="total" class="form-control" placeholder="$00.00">
                        </div>
                        <input type="submit" class="btn btn-success pull-right" value="Crear">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('change','#providers',function () {
                console.log('select ha cambiado');
                var provider_id = $(this).val();
//                console.log(provider_id);

                var div= $(this).parent();

                var op = " ";

                $.ajax({
                    type: 'get',
                    url: '{{route('findProductName')}}',
                    data:{'id':provider_id},
                    success:function (data) {
                        console.log('exito');

                        console.log(data);

                        console.log(data.length);
                        op+='<option value="0" selected disabled>--Elija Producto</option>';

                        for(var i=0; i < data.length; i++){
                                op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                            }

                        $('#products').html("");
                        $('#products').append(op);
                    },
                    error:function () {
                        
                    }
                });
            });
        });
    </script>
@endsection