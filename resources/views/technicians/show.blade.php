@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Técnico</h1><br>
            <h4>Nombre: {{ $technician->last_name.", ".$technician->first_name }}</h4>
            <h4>CUIT: {{$technician->cuit}}</h4>
            <h4>Dirección: {{$technician->address}}</h4>
            <h4>Tel: {{$technician->phone}}</h4>
            <h4>Email: {{$technician->email}}</h4>
        </div>
    </div>

@endsection