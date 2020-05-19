(function () {
    "use strict";

    $(document).ready(function () {
        $('#tableBooks').DataTable();
        $('#tableAuthors').DataTable();
        $('#tableCatalog').DataTable();
    });

    $('.procesando-envio').hide();

    $('#editar-libro').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data().id,
            title = $(e.relatedTarget).data().title,
            author = $(e.relatedTarget).data().author,
            description = $(e.relatedTarget).data().description;

        $('#book-id').val(id);
        $('#editbook-title').val(title);
        $('#editbook-author').val(author);
        $('#editbook-description').val(description);

        $('#editbook-form').on('submit', function (e) {
            e.preventDefault();

            $('.procesando-envio').show();

            $.ajax({
                url: '/edit-book',
                method: 'post',
                data: $(this).serializeArray()

            }).done(function (data, status) {
                $('.procesando-envio').hide();
                $('#editar-libro').modal('hide');

                setTimeout(function () {
                    location.reload();
                }, 600);
            }).fail(function () {
                alert('Error en la llamada AJAX');
                $('.procesando-envio').hide();
            });
        });
    });

    $('#editar-autor').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data().id,
            name = $(e.relatedTarget).data().name;

        $('#author-id').val(id);
        $('#editauthor-name').val(name);

        $('#editauthor-form').on('submit', function (e) {
            e.preventDefault();

            $('.procesando-envio').show();

            $.ajax({
                url: '/edit-author',
                method: 'post',
                data: $(this).serializeArray()

            }).done(function (data, status) {
                $('.procesando-envio').hide();
                $('#editar-autor').modal('hide');

                setTimeout(function () {
                    location.reload();
                }, 600);
            }).fail(function () {
                alert('Error en la llamada AJAX');
                $('.procesando-envio').hide();
            });
        });
    });

    $('#editar-catalogo').on('show.bs.modal', function (e) {
        var id       = $(e.relatedTarget).data().id,
            name     = $(e.relatedTarget).data().name,
            language = $(e.relatedTarget).data().language;

        $('#catalog-id').val(id);
        $('#editcatalog-name').val(name);
        $('#editcatalog-language').val(language);

        $('#editcatalog-form').on('submit', function (e) {
            e.preventDefault();

            $('.procesando-envio').show();

            $.ajax({
                url: '/edit-catalog',
                method: 'post',
                data: $(this).serializeArray()

            }).done(function (data, status) {
                $('.procesando-envio').hide();
                $('#editar-catalogo').modal('hide');

                setTimeout(function () {
                    location.reload();
                }, 600);
            }).fail(function () {
                alert('Error en la llamada AJAX');
                $('.procesando-envio').hide();
            });
        });
    });

    var includeFile = function () {
        var blockingDrop = function (event) {
            event.stopPropagation();
            event.preventDefault();

            event.dataTransfer.dropEffect = 'none';
            event.dataTransfer.effectAllowed = 'none';
        }

        var dragenter = function (event) {
            event.stopPropagation();
            event.preventDefault();
        }

        var dragoverIMG = function (event) {
            event.stopPropagation();
            event.preventDefault();

            $(this).addClass('highlight');

            $('#adjuntar-archivo-drag-img').css('display', 'none');
            $('#adjuntar-archivo-drop-img').css('display', 'inline');
        }

        var dragleaveIMG = function (event) {
            event.stopPropagation();
            event.preventDefault();

            $(this).removeClass('highlight');

            $('#adjuntar-archivo-drag-img').css('display', 'inline');
            $('#adjuntar-archivo-drop-img').css('display', 'none');
        }

        var dropIMG = function (event) {
            event.stopPropagation();
            event.preventDefault();

            var data = event.dataTransfer;
            var files = data.files;
            var file;
            var reader;

            for (var i = 0; i < files.length; i++) {
                file = files[i];

                reader = new FileReader();
                reader.fileName = file.name;
                reader.fileType = file.type;
                reader.onload = onFileLoadedIMG;
                reader.readAsDataURL(file);
            }
        }

        var onFileLoadedIMG = function (event) {
            $('#adjuntar-archivo-drop-img').html(event.currentTarget.fileName + '<p><small class="text-warning">Archivo subido correctamente</small></p>');
            $('#adjuntar-archivo-nombre-img').val(event.currentTarget.fileName);
            $('#adjuntar-archivo-datos-img').val(this.result);
        }

        var dragoverPDF = function (event) {
            event.stopPropagation();
            event.preventDefault();

            $(this).addClass('highlight');

            $('#adjuntar-archivo-drag-pdf').css('display', 'none');
            $('#adjuntar-archivo-drop-pdf').css('display', 'inline');
        }

        var dragleavePDF = function (event) {
            event.stopPropagation();
            event.preventDefault();

            $(this).removeClass('highlight');

            $('#adjuntar-archivo-drag-pdf').css('display', 'inline');
            $('#adjuntar-archivo-drop-pdf').css('display', 'none');
        }

        var dropPDF = function (event) {
            event.stopPropagation();
            event.preventDefault();

            var data = event.dataTransfer;
            var files = data.files;
            var file;
            var reader;

            for (var i = 0; i < files.length; i++) {
                file = files[i];

                reader = new FileReader();
                reader.fileName = file.name;
                reader.fileType = file.type;
                reader.onload = onFileLoadedPDF;
                reader.readAsDataURL(file);
            }
        }

        var onFileLoadedPDF = function (event) {
            $('#adjuntar-archivo-drop').html(event.currentTarget.fileName + '<p><small class="text-warning">Archivo subido correctamente</small></p>');
            $('#adjuntar-archivo-nombre-pdf').val(event.currentTarget.fileName);
            $('#adjuntar-archivo-datos-pdf').val(this.result);
        }

        document.body.addEventListener("dragover", blockingDrop, false);

        var contenedorIMG = document.getElementById("adjuntar-archivo-img"),
            contenedorPDF = document.getElementById("adjuntar-archivo-pdf");

        contenedorIMG.addEventListener("dragenter", dragenter, false);
        contenedorIMG.addEventListener("dragover", dragoverIMG, false);
        contenedorIMG.addEventListener("dragleave", dragleaveIMG, false);
        contenedorIMG.addEventListener("drop", dropIMG, false);

        contenedorPDF.addEventListener("dragenter", dragenter, false);
        contenedorPDF.addEventListener("dragover", dragoverPDF, false);
        contenedorPDF.addEventListener("dragleave", dragleavePDF, false);
        contenedorPDF.addEventListener("drop", dropPDF, false);
    }

    $(document).ready(function () {
        if (document.getElementById("adjuntar-archivo-img") != null) includeFile();
    });
}());
