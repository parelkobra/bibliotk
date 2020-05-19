<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <img class="logo" src="{{ url('images/general/logo.png') }}" alt="{{ trans('common.brand.title') }}" title="{{ trans('common.brand.title') }}" />
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li><a href="/home"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="/search" data-toggle="modal" data-target="#search-book"><i class="fa fa-search"></i> Buscar</a></li>
            <li><a href="/mylist"><i class="fa fa-star"></i> Mi lista</a></li>
            <li><a href="/catalog"><i class="fa fa-book"></i> Catalogos</a></li>
            <li><a href="/alphabetic"><i class="fa fa-font"></i> Orden Alfabetico</a></li>
            <li><a href="/author"><i class="fa fa-fire"></i> Por autor</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right navbar-user h4">
            <li class="dropdown user-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Session::get('profile') }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-wrench"></i> Datos de usuario</a></li>
                    <li><a href="/users"><i class="fa fa-user"></i> Cambiar de perfil</a></li>
                    <li class="divider"></li>
                    <li><a href="/logout"><i class="fa fa-power-off"></i> Salir</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>