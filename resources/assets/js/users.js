(function () {
    "use strict";

    $('#perfil-usuario').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data().id,
            name = $(e.relatedTarget).data().name,
            image = $(e.relatedTarget).data().image,
            color = $(e.relatedTarget).data().color;

        $('#profile-id').val(id);
        $('#profile-name').val(name);
        $('input[name="image"][value="' + image + '"]').prop('checked', true);
        $('#profile-color').val(color);

        $('.img-profile').css('filter', 'hue-rotate(' + $('#profile-color').val() + 'deg');

        $('#profile-color').on('change', function () {
            $('.img-profile').css('filter', 'hue-rotate(' + $(this).val() + 'deg');
        });

        $('#profile-form').on('submit', function (e) {
            e.preventDefault();

            $('#procesando-envio').show();

            $.ajax({
                url: '/update-profile',
                method: 'post',
                data: $(this).serializeArray()

            }).done(function (data, status) {
                $('#procesando-envio').hide();
                $('#perfil-usuario').modal('hide');

                setTimeout(function () {
                    location.reload();
                }, 600);
            }).fail(function () {
                alert('Error en la llamada AJAX');
                $('#procesando-envio').hide();
            });
        });
    });
}());
