<div class="modal-content">
    <form id="password-change-form" method="post" action="/cambiar-password" accept-charset="UTF-8">
        {!! csrf_field() !!}

        <div class="modal-header">
            <h3 class="text-primary">{{ trans('passwords.title') }}</h3>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <p>{{ trans('passwords.reset-warning') }}</p>
                </div>
                <div class="col-md-10">
                    <label for="email">{{ trans('passwords.email') }}</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" id="botton-cambiar-password" class="btn btn-lg btn-primary" data-dismiss="modal">{{ trans('passwords.button') }}</button>
            <button type="button" class="btn btn-lg btn-info" data-dismiss="modal">{{ trans('common.buttons.cancelar') }}</button>
        </div>
    </form>
</div>