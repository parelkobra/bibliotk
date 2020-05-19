@include('sections.header')

@include('sections.menu')

<div class="wrapper home">
    <div class="container-fluid section">
        <div class="row">
            <div class="jumbotron">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img src="{{ url('books/es/' . $book->id . '/portada.jpg') }}" alt="{{ $book->titulo }}">
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <h1>{{ $book->titulo }}</h1>
                    <h2>{{ $book->autor }}</h2>
                    <p>{{ $book->resumen }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container section">
        <div class="row options">
            <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#lectura-libro">Leer online</button>
            <button type="button" class="btn btn-lg btn-primary">Descargar</button>
            @if ($inlist)
            <a class="btn btn-lg btn-primary" href="/del-list/{{ $book->id }}">Eliminar de mi lista</a>
            @else
            <a class="btn btn-lg btn-primary" href="/add-list/{{ $book->id }}">Añadir a mi lista</a>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="lectura-libro" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        @include('modals.reader')
    </div>
</div>

@include('sections.footer')