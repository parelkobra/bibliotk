<div class="modal-content">
    <form id="register-form" method="post" action="/register" accept-charset="UTF-8">
        {!! csrf_field() !!}

        <div class="modal-header">
            <h3 class="text-primary">{{ trans('register.title') }}</h3>
        </div>

        <div class="modal-body scroller">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 class="text-secondary">{{ trans('register.subtitle') }}</h4>
                </div>
            </div>

            <div class="row">
                <div id="register-name" class="col-md-6">
                    <label for="name">{{ trans('register.form.nombre') }}</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>

                <div id="register-surnames" class="col-md-6">
                    <label for="surnames">{{ trans('register.form.apellidos') }}</label>
                    <input type="text" class="form-control" name="surnames" value="{{ old('surnames') }}">
                </div>
            </div>

            <div class="row">
                <div id="register-email" class="col-md-6">
                    <label for="email">{{ trans('register.form.email') }}</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                <div id="register-password" class="col-md-6">
                    <label for="password">{!! trans('register.form.password') !!}</label>
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 class="text-secondary">{{ trans('register.other.planes.title') }}<br><small>{{ trans('register.other.planes.description') }}</small></h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-xs-12 bg-info col-md-offset-1 planes">
                    <div class="col-md-1 col-xs-1">
                        <input type="radio" name="plan" value="1">
                    </div>
                    <div class="col-md-8 col-xs-7">
                        <h3>{{ trans('register.other.planes.plan1.title') }}</h3>
                        <p>{{ trans('register.other.planes.plan1.desc') }}</p>
                    </div>
                    <div class="col-md-3 col-xs-3">
                        <h3>0€</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-xs-12 bg-info col-md-offset-1 planes">
                    <div class="col-md-1 col-xs-1">
                        <input type="radio" name="plan" value="2">
                    </div>
                    <div class="col-md-8 col-xs-7">
                        <h3>{{ trans('register.other.planes.plan2.title') }}</h3>
                        <p>{{ trans('register.other.planes.plan2.desc') }}</p>
                    </div>
                    <div class="col-md-3 col-xs-3">
                        <h3>3.99€<small>/{{ trans('register.other.planes.time') }}</small></h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-xs-12 bg-info col-md-offset-1 planes">
                    <div class="col-md-1 col-xs-1">
                        <input type="radio" name="plan" value="3">
                    </div>
                    <div class="col-md-8 col-xs-7">
                        <h3>{{ trans('register.other.planes.plan3.title') }}</h3>
                        <p>{{ trans('register.other.planes.plan3.desc') }}</p>
                    </div>
                    <div class="col-md-3 col-xs-3">
                        <h3>5.99€<small>/{{ trans('register.other.planes.time') }}</small></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <div id="procesando-envio">Procesando registro de datos...</div>
            <button type="submit" class="btn btn-lg btn-primary">{{ trans('common.buttons.continuar') }}</button>
            <button type="button" class="btn btn-lg btn-info" data-dismiss="modal">{{ trans('common.buttons.cancelar') }}</button>
        </div>
    </form>
</div>