@include('sections.header')

@if (Session::get('rol') == 'admin')
<a class="btn btn-lg btn-success btn-admin" href="/admin">Panel admin</a>
@endif

<div class="wrapper users">
    <div class="container section">
        <div class="row">
            <div class="col-md-6 text-center col-md-offset-3">
                <img class="logo-big" src="{{ url('images/general/logo.png') }}" alt="{{ trans('common.brand.title') }}">
                <h2 class="text-primary">Selecciona perfil</h2>
                <h4 class="text-info">
                    <small>Crea, edita y selecciona uno de los perfiles disponibles.</small>
                </h4>
            </div>
        </div>

        @if (session()->has('error') && session('error'))
        <div class="row">
            <div class="col-md-6 col-sm-12 col-md-offset-3 alert alert-danger">
                {{ trans('users.error') }}
            </div>
        </div>
        @endif

        <div class="row profiles">
            @foreach ($profiles as $i => $profile)
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-primary o-hidden h-100" style="filter: hue-rotate({{ $profile->color }}deg);">
                    <div class="card-body">
                        <div class="card-body-icon">
                            @switch($profile->imagen)
                            @case(1) <i class="fa fa-fw fa-paper-plane"></i> @break
                            @case(2) <i class="fa fa-fw fa-futbol"></i> @break
                            @case(3) <i class="fa fa-fw fa-sun"></i> @break
                            @case(4) <i class="fa fa-fw fa-lightbulb"></i> @break
                            @case(5) <i class="fa fa-fw fa-smile"></i> @break
                            @case(6) <i class="fa fa-fw fa-star"></i> @break
                            @case(7) <i class="fa fa-fw fa-comments"></i> @break
                            @default <i class="fa fa-fw fa-user"></i>
                            @endswitch
                        </div>
                        <div class="mr-5">{{ $profile->nombre }}</div>
                    </div>
                    <div class="card-footer">
                        <a class="small" href="/select-profile/{{ $profile->id }}">
                            <span class="float-left">Acceso a mi perfil</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                
                <div class="card-edit text-center h1">
                    <a class="btn-edit bg-primary" href="#" 
                        data-id="{{ $profile->id }}" 
                        data-name="{{ $profile->nombre }}" 
                        data-image="{{ $profile->imagen }}" 
                        data-color="{{ $profile->color }}"
                        data-toggle="modal" 
                        data-target="#perfil-usuario">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="modal fade" id="perfil-usuario" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.profile')
    </div>
</div>

@include('sections.footer')