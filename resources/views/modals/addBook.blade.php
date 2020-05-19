<div class="modal-content">
    <form id="addbook-form" method="post" action="/add-book" accept-charset="UTF-8">
        {!! csrf_field() !!}

        <div class="modal-header">
            <h3 class="text-primary">Nuevo Libro</h3>
        </div>

        <div class="modal-body scroller">
            <div class="row">
                <div class="col-md-6">
                    <label for="addbook-title">Titulo</label>
                    <input id="addbook-title" type="text" class="form-control" name="title" value="">
                </div>
                <div class="col-md-6">
                    <label for="addbook-author">Autor</label>
                    <input id="addbook-author" type="text" class="form-control" name="author" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="addbook-description">Descripcion</label>
                    <textarea id="addbook-description" class="form-control" name="description"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="adjuntar-archivo-datos-img">Portada</label>
                    <p class="field field-value">
                        <span id="adjuntar-archivo-img">
                            <span id="adjuntar-archivo-drag-img">Arrastrar el archivo de imagen aquí</span>
                            <span id="adjuntar-archivo-drop-img">Puedes soltar la imagen</span>
                        </span>
                        <input type="hidden" id="adjuntar-archivo-nombre-img" name="nombre-archivo-img" value="">
                        <textarea id="adjuntar-archivo-datos-img" name="datos-archivo-img" class="hide"></textarea>
                    </p>
                </div>
                <div class="col-md-6">
                    <label for="adjuntar-archivo-datos-pdf">PDF libro</label>
                    <p class="field field-value">
                        <span id="adjuntar-archivo-pdf">
                            <span id="adjuntar-archivo-drag-pdf">Arrastrar el documento aquí</span>
                            <span id="adjuntar-archivo-drop-pdf">Puedes soltar el documento</span>
                        </span>
                        <input type="hidden" id="adjuntar-archivo-nombre-pdf" name="nombre-archivo-pdf" value="">
                        <textarea id="adjuntar-archivo-datos-pdf" name="datos-archivo-pdf" class="hide"></textarea>
                    </p>
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