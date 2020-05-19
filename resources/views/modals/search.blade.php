<div class="modal-content">
    <form id="search-form" method="get" action="/search" accept-charset="UTF-8">
        {!! csrf_field() !!}

        <div class="modal-header">
            <h3 class="text-primary">Buscador</h3>
        </div>

        <div class="modal-body scroller">
            <div class="row">
                <div id="search-title" class="col-md-6">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" name="title" value="">
                </div>

                <div id="search-author" class="col-md-6">
                    <label for="author">Autor</label>
                    <input type="text" class="form-control" name="author" value="">
                </div>
            </div>

            <div class="row">
                <div id="search-language" class="col-md-6">
                    <label for="language">Idioma</label>
                    <input type="text" class="form-control" name="language" value="">
                </div>

                <div id="search-catalog" class="col-md-6">
                    <label for="catalog">Catálogo</label>
                    <input type="text" class="form-control" name="catalog" value="">
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <div id="procesando-envio">Procesando búsqueda...</div>
            <button type="submit" class="btn btn-lg btn-primary">Buscar</button>
            <button type="button" class="btn btn-lg btn-info" data-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>