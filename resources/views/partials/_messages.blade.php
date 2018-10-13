@if (Session::has('success'))

    <div class="alert alert-success" role="alert">
        <strong>Sucess:</strong> {{ Session::get('success') }}
    </div>

@endif

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <strong>Corrige los siguientes errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif