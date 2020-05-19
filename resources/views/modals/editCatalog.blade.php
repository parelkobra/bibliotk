<div class="modal-content">
    <form id="editcatalog-form" method="post" action="/edit-catalog" accept-charset="UTF-8">
        {!! csrf_field() !!}

        <input id="catalog-id" type="hidden" name="id" value="">

        <div class="modal-header">
            <h3 class="text-primary">Editar Catálogo</h3>
        </div>

        <div class="modal-body scroller">
            <div class="row">
                <div class="col-md-6">
                    <label for="editcatalog-name">Nombre</label>
                    <input id="editcatalog-name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
                <div class="col-md-6">
                    <label for="editcatalog-language">Idioma</label>
                    <input id="editcatalog-language" type="text" class="form-control" name="language" value="{{ old('language') }}">
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