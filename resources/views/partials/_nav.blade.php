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
                    <li class="@yield('home_link')"><a href="/">Principal<span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Productos <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/products">Lista</a></li>
                            <li><a href="/products/create">Nuevo Prod</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Proveedores <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/providers">Lista</a></li>
                            <li><a href="/providers/create">Nuevo Proveedor</a></li>
                            <li><a href="/products_providers/create">Asignar Productos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Ordenes de Compra <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/purchase_orders">Lista</a></li>
                            <li><a href="/purchase_orders/create">Nueva Orden</a></li>

                        </ul>
                    </li>
                    <li class="@yield('tecnicos_link')"><a href="/technicians">Serv. Técnico</a></li>

                </ul>
            @endif
            <ul class="nav navbar-nav navbar-right">
                {{--<li><a href="#">Link</a></li>--}}
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{ Auth::user()->email }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            {{--<li><a href="/blog">Blog</a></li>--}}

                            {{--<li><a href="#">Posts</a></li>--}}
                            {{--<li><a href="#">Categories</a></li>--}}
                            {{--<li><a href="#">Tags</a></li>--}}

                            {{--<li role="separator" class="divider"></li>--}}
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
