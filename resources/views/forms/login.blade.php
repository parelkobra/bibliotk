@extends('login')

@section('content')

@if (session()->has('error') && session('error'))
<div class="form-group alert alert-danger">
    {{ trans('login.error') }}
</div>
@endif

<form id="login-form" method="post" action="/login" accept-charset="UTF-8">
    {!! csrf_field() !!}
    
    <div class="form-group input-group-lg @if ($errors->has('email')) has-error @endif">
        <div class="input-group input-group-lg">
            <div class="input-group-addon"><i class="fa fa-at"></i></div>
            <input type="text" class="form-control" id="email" name="email" placeholder="{{ trans('login.form.email') }}" value="{{ old('email') }}">
        </div>
        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
    </div>

    <div class="form-group input-group-lg @if ($errors->has('password')) has-error @endif">
        <div class="input-group input-group-lg">
            <div class="input-group-addon"><i class="fa fa-lock"></i></div>
            <input type="password" class="form-control" id="password" name="password" placeholder="{{ trans('login.form.password') }}">
        </div>
        @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
    </div>

    <div class="form-group text-center">
        <button class="btn btn-primary btn-lg btn-block">{{ trans('login.form.iniciar') }}</button>
    </div>

    <div class="row">
        <div class="checkbox col-md-5">
            <label>
                <input name="remember" type="checkbox" value="{{ trans('login.form.recuerda') }}">{{ trans('login.form.recuerda') }}
            </label>
        </div>

        <div class="col-md-7 text-right">
            <a href="{{ trans('login.links.recuerda_password.link') }}" title="{{ trans('login.links.recuerda_password.title') }}" data-toggle="modal" data-target="#cambio-password">{{ trans('login.links.recuerda_password.title') }}</a>
        </div>
    </div>

    <div class="form-group text-center">
        {{ trans('login.links.registro_usuario.texto') }}
        <a href="{{ trans('login.links.registro_usuario.link') }}" title="{{ trans('login.links.registro_usuario.title') }}" data-toggle="modal" data-target="#registro-usuario">{{ trans('login.links.registro_usuario.title') }}</a>
    </div>
</form>

@endsection