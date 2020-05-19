<div class="modal-content">
    <form id="editauthor-form" method="post" action="/edit-author" accept-charset="UTF-8">
        {!! csrf_field() !!}

        <input id="author-id" type="hidden" name="id" value="">

        <div class="modal-header">
            <h3 class="text-primary">Editar Autor</h3>
        </div>

        <div class="modal-body scroller">
            <div class="row">
                <div class="col-md-6">
                    <label for="editauthor-name">Nombre</label>
                    <input id="editauthor-name" type="text" class="form-control" name="name" value="{{ old('name') }}">
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