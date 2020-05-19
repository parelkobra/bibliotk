@include('sections.header')

@include('sections.menu')

<div class="wrapper home">

    <div class="container section">

        <div class="row news">
            @foreach($result as $book)

                <h2>Hola</h2>
                <h3>{{ $book->titulo }}</h3>

            @endforeach
        </div>
        <div class="text-center">
            <a class="btn btn-lg btn-success" href="/author?page=1">1</a>
            <a class="btn btn-lg btn-success" href="/author?page=2">2</a>
            <a class="btn btn-lg btn-success" href="/author?page=3">3</a>
            <a class="btn btn-lg btn-success" href="/author?page=4">4</a>
        </div>

    </div>

    <div class="modal fade" id="search-book" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            @include('modals.search')
        </div>
    </div>

</div>

@include('sections.footer')