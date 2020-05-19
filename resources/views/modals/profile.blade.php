<div class="modal-content">
    <form id="profile-form" method="post" action="/update-profile" accept-charset="UTF-8">
        {!! csrf_field() !!}

        <input id="profile-id" type="hidden" name="id" value="">

        <div class="modal-header">
            <h3 class="text-primary">{{ trans('users.title') }}</h3>
        </div>

        <div class="modal-body scroller">
            <div class="row">
                <div class="col-md-5">
                    <label for="profile-name">{{ trans('users.form.nombre') }}</label>
                    <input id="profile-name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>

                <div class="col-md-7">
                    <label for="image">{{ trans('users.form.imagen') }}</label>
                    <div>
                        <div class="img-profile"><i class="fa fa-fw fa-paper-plane"></i></div>
                        <div class="img-profile"><i class="fa fa-fw fa-futbol"></i></div>
                        <div class="img-profile"><i class="fa fa-fw fa-sun"></i></div>
                        <div class="img-profile"><i class="fa fa-fw fa-lightbulb"></i></div>
                        <div class="img-profile"><i class="fa fa-fw fa-smile"></i></div>
                        <div class="img-profile"><i class="fa fa-fw fa-star"></i></div>
                        <div class="img-profile"><i class="fa fa-fw fa-comments"></i></div>
                        <div class="img-profile"><i class="fa fa-fw fa-user"></i></div>
                    </div>
                    <div class="radio-profile">
                        <input type="radio" name="image" value="1">
                        <input type="radio" name="image" value="2">
                        <input type="radio" name="image" value="3">
                        <input type="radio" name="image" value="5">
                        <input type="radio" name="image" value="6">
                        <input type="radio" name="image" value="6">
                        <input type="radio" name="image" value="7">
                        <input type="radio" name="image" value="0">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="color">Color</label>
                    <input id="profile-color" type="range" class="form-control" name="color" min="0" max="360" value="0">
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