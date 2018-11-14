<!-- Default Bootstrap Navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Gestión de Proveedores 2018</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if (Auth::check())
                <ul class="nav navbar-nav">
                    <li class="@yield('home_link')"><a href="/">Inicio<span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="{{ route('users.index') }}">Usuarios</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('products.index') }}">Productos</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('providers.index') }}">Proveedores</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('purchase_orders.index') }}">Órdenes de Compra</a>
                    </li>
                    <li class="@yield('tecnicos_link')"><a href="{{ route('technicians.index') }}">Servicio Técnico</a></li>

                </ul>
            @endif
            <ul class="nav navbar-nav navbar-right">
                {{--<li><a href="#">Link</a></li>--}}
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href=" {{ route('logout') }} ">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav> <!-- END NAVBAR -->
