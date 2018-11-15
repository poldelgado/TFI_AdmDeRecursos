@extends('main')

@section('content')
<link rel="stylesheet" type="text/css" href="resources/app-all.css">
<script type="text/javascript" src="ext-all.js"></script>
<script type="text/javascript" src="app.js"></script>


<!--div class="row">
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
</div-->

@endsection
