<div class="modal-content">
    <form id="addauthor-form" method="post" action="/add-author" accept-charset="UTF-8">
        {!! csrf_field() !!}

        <div class="modal-header">
            <h3 class="text-primary">Nuevo Autor</h3>
        </div>

        <div class="modal-body scroller">
            <div class="row">
                <div class="col-md-6">
                    <label for="addauthor-name">Nombre</label>
                    <input id="addauthor-name" type="text" class="form-control" name="name" value="">
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <div class="procesando-envio">Procesando registro de datos...</div>
            <button type="submit" class="btn btn-lg btn-primary">{{ trans('common.buttons.aceptar') }}</button>
            <button type="button" class="btn btn-lg btn-info" data-dismiss="modal">{{ trans('common.buttons.cancelar') }}</button>
        </div>
    </form>
</div>