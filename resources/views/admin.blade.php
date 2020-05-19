@include('sections.header')

<a class="btn btn-lg btn-success btn-admin" href="/users">Perfiles usuario</a>

<div class="wrapper users" style="margin-top: 60px;">
    <div class="container section">

        <div class="row">
            <div class="col-md-6 text-center col-md-offset-3">
                <h2>Panel de Administración</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 text-center col-md-offset-3">
                <h3>Libros</h3>
            </div>
        </div>
        <div class="table table-bordered" style="padding:10px; border-radius:7px">
            <button type="button" data-toggle="modal" data-target="#nuevo-libro" class="btn btn-primary">Nuevo libro</button>
            <table id="tableBooks">
                <thead>
                    <tr>
                        <th style="width:60px">id</th>
                        <th>Nombre</th>
                        <th>Autor</th>
                        <th>F. Publicación</th>
                        <th style="width:140px">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->titulo }}</td>
                        <td>{{ $book->autor }}</td>
                        <td>{{ $book->fecha_publicacion }}</td>
                        <td>
                            <button type="button" 
                                data-id="{{ $book->id }}"
                                data-title="{{ $book->titulo }}"
                                data-author="{{ $book->autor }}"
                                data-description="{{ $book->resumen }}"
                                data-toggle="modal" 
                                data-target="#editar-libro" 
                                class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </button>
                            <a href="/del-book/{{ $book->id }}" class="btn btn-info">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-6 text-center col-md-offset-3">
                <h3>Autores</h3>
            </div>
        </div>
        <div class="table table-bordered" style="padding:10px; border-radius:7px">
            <button type="button" data-toggle="modal" data-target="#nuevo-autor" class="btn btn-primary">Nuevo autor</button>
            <table id="tableAuthors">
                <thead>
                    <tr>
                        <th style="width:60px">id</th>
                        <th>Nombre</th>
                        <th style="width:140px">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td>{{ $author->nombre }}</td>
                        <td>
                            <button type="button" 
                                data-id="{{ $author->id }}"
                                data-name="{{ $author->nombre }}"
                                data-toggle="modal" 
                                data-target="#editar-autor" 
                                class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </button>
                            <a href="/del-author/{{ $author->id }}" class="btn btn-info">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-6 text-center col-md-offset-3">
                <h3>Catálogo</h3>
            </div>
        </div>
        <div class="table table-bordered" style="padding:10px; border-radius:7px">
            <button type="button" data-toggle="modal" data-target="#nuevo-catalogo" class="btn btn-primary">Nuevo autor</button>
            <table id="tableCatalog">
                <thead>
                    <tr>
                        <th style="width:60px">id</th>
                        <th>Nombre</th>
                        <th>Idioma</th>
                        <th style="width:140px">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($catalogs as $catalog)
                    <tr>
                        <td>{{ $catalog->id }}</td>
                        <td>{{ $catalog->nombre }}</td>
                        <td>{{ $catalog->idioma }}</td>
                        <td>
                            <button type="button" 
                                data-id="{{ $catalog->id }}"
                                data-name="{{ $catalog->nombre }}"
                                data-language="{{ $catalog->idioma }}"
                                data-toggle="modal" 
                                data-target="#editar-catalogo" 
                                class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </button>
                            <a href="/del-catalog/{{ $catalog->id }}" class="btn btn-info">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="modal fade" id="nuevo-libro" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.addBook')
    </div>
</div>

<div class="modal fade" id="editar-libro" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.editBook')
    </div>
</div>

<div class="modal fade" id="nuevo-autor" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.addAuthor')
    </div>
</div>

<div class="modal fade" id="editar-autor" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.editAuthor')
    </div>
</div>

<div class="modal fade" id="nuevo-catalogo" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.addCatalog')
    </div>
</div>

<div class="modal fade" id="editar-catalogo" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.editCatalog')
    </div>
</div>

@include('sections.footer')