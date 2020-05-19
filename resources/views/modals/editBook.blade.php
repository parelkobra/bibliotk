<div class="modal-content">
    <form id="editbook-form" method="post" action="/edit-book" accept-charset="UTF-8">
        {!! csrf_field() !!}

        <input id="book-id" type="hidden" name="id" value="">

        <div class="modal-header">
            <h3 class="text-primary">Editar Libro</h3>
        </div>

        <div class="modal-body scroller">
            <div class="row">
                <div class="col-md-6">
                    <label for="editbook-title">Titulo</label>
                    <input id="editbook-title" type="text" class="form-control" name="title" value="">
                </div>
                <div class="col-md-6">
                    <label for="editbook-author">Autor</label>
                    <input id="editbook-author" type="text" class="form-control" name="author" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="editbook-description">Descripción</label>
                    <textarea id="editbook-description" class="form-control" name="description"></textarea>
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