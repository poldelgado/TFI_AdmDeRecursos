@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>Proveedores</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('providers.create')  }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Nuevo Proveedor</a>
        </div>
        <div class="col-md-12">

            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>CUIT</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>email</th>
                </thead>
                <tbody>
                    @foreach($providers as $provider)

                        <tr>
                            <td>{{$provider->id}}</td>
                            <td>{{$provider->name}}</td>
                            <td>{{$provider->cuit}}</td>
                            <td>{{$provider->address}}</td>
                            <td>{{$provider->phone}}</td>
                            <td>{{$provider->email}}</td>
                            <td><a class="btn btn-xs btn-primary" href="{{route('providers.show', $provider->id)}}">ver</a>
                                <a class="btn btn-xs btn-primary" href="{{ route('providers.edit', $provider->id) }}">Editar</a>
                                <form action="{{route('providers.destroy', $provider->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                    <input type="submit" value="Eliminar" class="btn btn-danger btn-xs">
                                </form>
                        </tr>


                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection