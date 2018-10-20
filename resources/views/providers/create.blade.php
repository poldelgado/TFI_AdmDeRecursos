@extends('main')

@section('stylesheets')
    <link rel="stylesheet" href="/css/select2.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Nuevo Proveedor </h2>
                </div>
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
                        <div class="form-group">
                            <label for="technicians">Técnicos Autorizados</label>
                            <select name="technicians[]" class="form-control select2-multi" multiple="multiple">
                                @foreach($technicians as $technician)

                                    <option value="{{ $technician->id }}"> {{$technician->last_name.", ".$technician->first_name}} </option>

                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success pull-right">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/select2.min.js"></script>
    <script>
        $('.select2-multi').select2();
    </script>
@endsection