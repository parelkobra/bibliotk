@include('sections.header')

<div class="wrapper login">
    <div class="login-wrapper">

        <div class="logo text-center">
            <img src="{{ url('images/general/logo.png') }}" alt="{{ trans('common.brand.title') }}" title="{{ trans('common.brand.title') }}" />
        </div>

        @yield('content')
    </div>
</div>

<div class="language-selector">
    <select id="select-languages" class="selectpicker show-tick">
        <option value="es" @if (App::getLocale() == 'es') selected @endif>{{ trans('login.language.spanish') }}</option>
        <option value="en" @if (App::getLocale() == 'en') selected @endif>{{ trans('login.language.english') }}</option>
    </select>
</div>

<div class="modal fade" id="registro-usuario" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.register')
    </div>
</div>

<div class="modal fade" id="cambio-password" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.password')
    </div>
</div>

@include('sections.footer')