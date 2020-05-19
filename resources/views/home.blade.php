@include('sections.header')

@include('sections.menu')

<div class="wrapper home">
@if ($section == 'home')
    <div class="container-fluid section">
        <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <div class="item-book0" style="background: url('{{ url('books/es/1/portada.jpg') }}') 50% 50%; background-size: cover"></div>
                        <p class="h1">Don Quijote de la Mancha<small>Miguel de Cervantes</small></p>
                    </div>

                    <div class="item">
                        <div class="item-book1" style="background: url('{{ url('books/es/2/portada.jpg') }}') 50% 50%; background-size: cover"></div>
                        <p class="h1">Harry Potter y el cáliz de fuego <small>J. K. Rowling</small></p>
                    </div>

                    <div class="item">
                        <div class="item-book2" style="background: url('{{ url('books/es/3/portada.jpg') }}') 50% 50%; background-size: cover"></div>
                        <p class="h1">Juego de Tronos <small>George R. R. Martin</small></p>
                    </div>
                </div>

                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
@endif

@if ($section == 'search') <div class="text-center" style="margin: 70px auto 20px;"><h1><i class="fa fa-search"></i> Buscar</h1></div> @endif
@if ($section == 'mylist') <div class="text-center" style="margin: 70px auto 20px;"><h1><i class="fa fa-star"></i> Mi lista</h1></div> @endif
@if ($section == 'catalog') <div class="text-center" style="margin: 70px auto 20px;"><h1><i class="fa fa-book"></i> Por catálogo</h1></div> @endif
@if ($section == 'alphabetic') <div class="text-center" style="margin: 70px auto 20px;"><h1><i class="fa fa-font"></i> Orden Alfabético</h1></div> @endif
@if ($section == 'author') <div class="text-center" style="margin: 70px auto 20px;"><h1><i class="fa fa-fire"></i> Por autor</h1></div> @endif

    <div class="container section">
    @if ($section == 'home')
        <div class="row categories">
            <h2>Nuestro catálogo de...</h2>
            <div class="row">
                <a href="#" title="Clasicos">
                    <div class="col-md-2 col-sm-4 col-xs-6 category bg-primary" style="filter: hue-rotate(0deg)">
                        <div>Clasicos</div>
                    </div>
                </a>
                <a href="#" title="Fantasia">
                    <div class="col-md-2 col-sm-4 col-xs-6 category bg-primary" style="filter: hue-rotate(50deg)">
                        <div>Fantasía</div>
                    </div>
                </a>
                <a href="#" title="Terror">
                    <div class="col-md-2 col-sm-4 col-xs-6 category bg-primary" style="filter: hue-rotate(100deg)">
                        <div>Terror</div>
                    </div>
                </a>
                <a href="#" title="Ciencia Ficcion">
                    <div class="col-md-2 col-sm-4 col-xs-6 category bg-primary" style="filter: hue-rotate(150deg)">
                        <div>Ciencia Ficción</div>
                    </div>
                </a>
                <a href="#" title="Filosofia">
                    <div class="col-md-2 col-sm-4 col-xs-6 category bg-primary" style="filter: hue-rotate(200deg)">
                        <div>Filosofía</div>
                    </div>
                </a>
                <a href="#" title="Infantil">
                    <div class="col-md-2 col-sm-4 col-xs-6 category bg-primary" style="filter: hue-rotate(250deg)">
                        <div>Infantil</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row news">
            <h2>Novedades en BiblioTk</h2>
            @foreach ($books as $book)
            <a href="/book/{{ $book->id }}" title="{{ $book->titulo }}">
                <div class="col-md-3 col-sm-6 col-xs-6 book">
                    <div>
                        <img src="{{ url('books/es/' . $book->id . '/portada.jpg') }}">
                        <h5>{{ $book->titulo }}<small>{{ $book->autor }}</small></h5>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @endif

    @if (!empty($mylist))
        <div class="row news">
            @if ($section == 'home') <h2>Mi lista</h2> @endif

            @foreach ($mylist as $book)
            <a href="/book/{{ $book->id }}" title="{{ $book->titulo }}">
                <div class="col-md-3 col-sm-6 col-xs-6 book">
                    <div>
                        <img src="{{ url('books/es/' . $book->id . '/portada.jpg') }}">
                        <h5>{{ $book->titulo }}<small>{{ $book->autor }}</small></h5>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @endif
    
    @if ($section == 'alphabetic')
        <div class="row news">

            @foreach($groups as $letter => $group)
                <h2>{{ $letter }}</h2>
                
                <div class="row spacing">
                    @foreach($group as $book)
                    <a href="/book/{{ $book['id'] }}" title="{{ $book['titulo'] }}">
                        <div class="col-md-3 col-sm-6 col-xs-6 book">
                            <div>
                                <img src="{{ url('books/es/' . $book['id'] . '/portada.jpg') }}">
                                <h5>{{ $book['titulo'] }}<small>{{ $book['autor'] }}</small></h5>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endforeach
        </div>
        </div>
        <div class="text-center">
            <a class="btn btn-lg btn-success" href="/alphabetic?page=1">1</a>
            <a class="btn btn-lg btn-success" href="/alphabetic?page=2">2</a>
            <a class="btn btn-lg btn-success" href="/alphabetic?page=3">3</a>
        </div>
    @endif

    @if ($section == 'catalog')
        <div class="row news">

            @foreach($groups as $catalog => $group)
                <h2>{{ $catalog }}</h2>
                
                <div class="row spacing">
                    @foreach($group as $book)
                    <a href="/book/{{ $book['id'] }}" title="{{ $book['titulo'] }}">
                        <div class="col-md-3 col-sm-6 col-xs-6 book">
                            <div>
                                <img src="{{ url('books/es/' . $book['id'] . '/portada.jpg') }}">
                                <h5>{{ $book['titulo'] }}<small>{{ $book['autor'] }}</small></h5>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div> 
            @endforeach
        </div>
        <div class="text-center">
            <a class="btn btn-lg btn-success" href="/catalog?page=1">1</a>
            <a class="btn btn-lg btn-success" href="/catalog?page=2">2</a>
            <a class="btn btn-lg btn-success" href="/catalog?page=3">3</a>
        </div>
    @endif
    
    @if ($section == 'author')
        <div class="row news">

            @foreach($groups as $author => $group)
                <h2>{{ $author }}</h2>
                
                <div class="row spacing">
                    @foreach($group as $book)
                    <a href="/book/{{ $book['id'] }}" title="{{ $book['titulo'] }}">
                        <div class="col-md-3 col-sm-6 col-xs-6 book">
                            <div>
                                <img src="{{ url('books/es/' . $book['id'] . '/portada.jpg') }}">
                                <h5>{{ $book['titulo'] }}<small>{{ $book['autor'] }}</small></h5>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="text-center">
            <a class="btn btn-lg btn-success" href="/author?page=1">1</a>
            <a class="btn btn-lg btn-success" href="/author?page=2">2</a>
            <a class="btn btn-lg btn-success" href="/author?page=3">3</a>
            <a class="btn btn-lg btn-success" href="/author?page=4">4</a>
        </div>
    @endif
    </div>

    <div class="modal fade" id="search-book" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            @include('modals.search')
        </div>
    </div>

</div>

@include('sections.footer')