@extends('main')

@section('title', '| Nuevo Técnico')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>Técnicos</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('technicians.create')  }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Nuevo Técnico</a>
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
                @foreach($technicians as $technician)
                    <tr>
                        <td>{{$technician->id}}</td>
                        <td>{{$technician->last_name}}</td>
                        <td>{{$technician->first_name}}</td>
                        <td>{{$technician->cuit}}</td>
                        <td>{{$technician->phone}}</td>
                        <td>{{$technician->email}}</td>
                        <td>{{$technician->address}}</td>
                        <td><a class="btn btn-sm btn-default" href="{{route('technicians.show', $technician->id)}}">ver</a>
                            <a class="btn btn-sm btn-default" href="{{ route('technicians.edit', $technician->id) }}">Editar</a>
                            <form action="{{route('technicians.destroy', $technician->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <input type="submit" value="Eliminar" class="btn btn-danger btn-xs">
                            </form></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection