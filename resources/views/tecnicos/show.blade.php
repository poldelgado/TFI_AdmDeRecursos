@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Tecnico</h1><br>
            <h4>Nombre: {{ $tecnico->last_name.", ".$tecnico->first_name }}</h4>
            <h4>CUIT: {{$tecnico->cuit}}</h4>
            <h4>Dirección: {{$tecnico->address}}</h4>
            <h4>Tel: {{$tecnico->phone}}</h4>
            <h4>Email: {{$tecnico->email}}</h4>
        </div>
    </div>

@endsection