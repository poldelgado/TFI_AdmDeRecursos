@extends('main')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>Productos</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('products.create')  }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Nuevo Producto</a>
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
                <th>Descripción</th>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td><a class="btn btn-xs btn-primary" href="{{route('products.show', $product->id)}}">Ver</a>
                            <a class="btn btn-xs btn-primary" href="{{ route('products.edit', $product->id) }}">Editar</a>
                            <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <input type="submit" value="Eliminar" class="btn btn-danger btn-xs">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection