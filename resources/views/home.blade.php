@extends('main')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Bienvenido</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h3 class="text-center">Sistema de Gestión de Proveedores</h3>
            </div>
        </div>
    </div>
</div>

@endsection
