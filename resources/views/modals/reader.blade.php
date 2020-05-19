<div class="modal-content">
    <div class="modal-header">
        <h3 class="text-primary">{{ $book->titulo }}</h3>
    </div>

    <section class="modal-body scroller">
        <canvas id="bookreader"></canvas>
    </section>

    <div class="modal-footer">
        <div class="col-sm-6 text-left">
            <button id="full" class="btn btn-lg btn-primary"><i class="fa fa-fw fa-expand"></i></button>
            <button id="prev" class="btn btn-lg btn-primary"><i class="fa fa-fw fa-angle-left"></i></button>
            <span>Página: <span id="page_num"></span> / <span id="page_count"></span></span>
            <button id="next" class="btn btn-lg btn-primary"><i class="fa fa-fw fa-angle-right"></i></button>
        </div>
        <div class="col-sm-4 text-center">
            <button id="minus" class="btn btn-lg btn-primary"><i class="fa fa-fw fa-minus"></i></button>
            <button id="plus" class="btn btn-lg btn-primary"><i class="fa fa-fw fa-plus"></i></button>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-lg btn-info" data-dismiss="modal">{{ trans('common.buttons.cerrar') }}</button>
        </div>
    </div>
    <script src="{{ url('js/pdf.js') }}"></script>

    <script id="script">
        window.onload = function() {

            //
            // If absolute URL from the remote server is provided, configure the CORS
            // header on that server.
            //
            var url = "{{ url('/books/es/1/archivo.pdf') }}";


            //
            // Disable workers to avoid yet another cross-origin issue (workers need
            // the URL of the script to be loaded, and dynamically loading a cross-origin
            // script does not work).
            //
            PDFJS.disableWorker = true;

            //
            // In cases when the pdf.worker.js is located at the different folder than the
            // pdf.js's one, or the pdf.js is executed via eval(), the workerSrc property
            // shall be specified.
            //
            PDFJS.workerSrc = "{{ url('js/app.worker.js') }}";

            var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 4, //scale = 1,
                zoom = 1,
                canvas = document.getElementById('bookreader'),
                ctx = canvas.getContext('2d');

            /**
             * Get page info from document, resize canvas accordingly, and render page.
             * @param num Page number.
             */
            function renderPage(num) {
                pageRendering = true;

                document.getElementsByTagName('section')[0].scrollTop = 0;

                // Using promise to fetch the page
                pdfDoc.getPage(num).then(function(page) {
                    var viewport = page.getViewport(0.8),
                        desiredWidth = 1200;

                    scale = desiredWidth / viewport.width;

                    var scaledViewport = page.getViewport(scale);

                    canvas.width = scaledViewport.width; //canvas.width  = 588; //viewport.width;
                    canvas.height = scaledViewport.height; //3168; //canvas.height = 790; //viewport.height;

                    // Render PDF page into canvas context
                    var renderContext = {
                        canvasContext: ctx,
                        viewport: scaledViewport
                    };

                    canvas.style.width = '100%';
                    canvas.style.height = 'auto';

                    //console.log(renderContext.viewport);
                    var renderTask = page.render(renderContext);

                    // Wait for rendering to finish
                    renderTask.promise.then(function() {
                        pageRendering = false;
                        if (pageNumPending !== null) {
                            // New page rendering is pending
                            renderPage(pageNumPending);
                            pageNumPending = null;
                        }
                    });
                });

                // Update page counters
                document.getElementById('page_num').textContent = pageNum;
            }

            /**
             * If another page rendering in progress, waits until the rendering is
             * finised. Otherwise, executes rendering immediately.
             */
            function queueRenderPage(num) {
                if (pageRendering) {
                    pageNumPending = num;
                } else {
                    renderPage(num);
                }
            }

            /**
             * Displays previous page.
             */
            function onPrevPage() {
                if (pageNum <= 1) {
                    return;
                }
                pageNum--;
                queueRenderPage(pageNum);
            }
            document.getElementById('prev').addEventListener('click', onPrevPage);

            /**
             * Displays next page.
             */
            function onNextPage() {
                if (pageNum >= pdfDoc.numPages) {
                    return;
                }
                pageNum++;
                queueRenderPage(pageNum);
            }
            document.getElementById('next').addEventListener('click', onNextPage);

            /**
             * Displays zoom plus page
             */
            function onNextZoom() {
                if (zoom >= 2) {
                    return;
                }

                zoom += 0.5;

                document.getElementsByTagName('section')[0].style.overflow = 'scroll';
                canvas.style.width = 'calc(100% * ' + zoom + ')';
            }
            document.getElementById('plus').addEventListener('click', onNextZoom);

            /**
             * Displays zoom minus page
             */
            function onPrevZoom() {
                if (zoom <= 1) {
                    return;
                }

                zoom -= 0.5;
                if (zoom < 1.5) document.getElementsByTagName('section')[0].style.overflow = 'auto';
                canvas.style.width = 'calc(100% * ' + zoom + ')';
            }
            document.getElementById('minus').addEventListener('click', onPrevZoom);


            function openFullscreen() {
                if (canvas.requestFullscreen) {
                    canvas.requestFullscreen();
                } else if (canvas.mozRequestFullScreen) {
                    /* Firefox */
                    canvas.mozRequestFullScreen();
                } else if (canvas.webkitRequestFullscreen) {
                    /* Chrome, Safari and Opera */
                    canvas.webkitRequestFullscreen();
                } else if (canvas.msRequestFullscreen) {
                    /* IE/Edge */
                    canvas.msRequestFullscreen();
                }
            }
            document.getElementById('full').addEventListener('click', openFullscreen);

            /**
             * Asynchronously downloads PDF.
             */
            PDFJS.getDocument(url).then(function(pdfDoc_) {
                console.log(pdfDoc_);
                pdfDoc = pdfDoc_;
                document.getElementById('page_count').textContent = pdfDoc.numPages;

                // Initial/first page rendering
                renderPage(pageNum);
            });
        }
    </script>
</div>