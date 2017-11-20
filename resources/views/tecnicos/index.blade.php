@extends('main')

@section('title', '| Nuevo Técnico')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>Técnicos</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('tecnicos.create')  }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Nuevo Técnico</a>
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
                <th>Apellido</th>
                <th>Nombre</th>
                <th>CUIT</th>
                <th>Teléfono</th>
                <th>email</th>
                <th>Dirección</th>
                </thead>
                <tbody>
                @foreach($tecnicos as $tecnico)
                    <tr>
                        <td>{{$tecnico->id}}</td>
                        <td>{{$tecnico->last_name}}</td>
                        <td>{{$tecnico->first_name}}</td>
                        <td>{{$tecnico->cuit}}</td>
                        <td>{{$tecnico->phone}}</td>
                        <td>{{$tecnico->email}}</td>
                        <td>{{$tecnico->address}}</td>
                        <td><a class="btn btn-sm btn-default" href="{{route('tecnicos.show', $tecnico->id)}}">ver</a>
                            <a class="btn btn-sm btn-default" href="{{ route('tecnicos.edit', $tecnico->id) }}">Editar</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection