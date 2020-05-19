(function () {
    'use strict';

    $('select').selectpicker();
    $('#procesando-envio').hide();

    $('#select-languages').on('change', function (e) {
        var sel = $('#select-languages :selected').val();

        window.location.href = '/language/' + sel;
    });

    $('#register-form').on('submit', function (e) {
        e.preventDefault();

        $('#procesando-envio').show();
        $('#register-name').removeClass('has-error');
        $('#register-surnames').removeClass('has-error');
        $('#register-email').removeClass('has-error');
        $('#register-password').removeClass('has-error');

        $.ajax({
            url: '/register',
            method: 'post',
            data: $(this).serializeArray()
        }).done(function (data, status) {
            $('#procesando-envio').hide();

            setTimeout(function () {
                alert('El registro se ha realizado con éxito!');
                $('#registro-usuario').modal('hide');
                $('#register-form')[0].reset();
            }, 1000);
        }).fail(function (jqXHR) {
            var aviso = '';

            if (jqXHR.responseJSON.errors !== undefined) {
                if (jqXHR.responseJSON.errors.name) {
                    $('#register-name').addClass('has-error');
                    aviso += jqXHR.responseJSON.errors.name + '\n';
                }
                if (jqXHR.responseJSON.errors.surnames) {
                    $('#register-surnames').addClass('has-error');
                    aviso += jqXHR.responseJSON.errors.surnames + '\n';
                }
                if (jqXHR.responseJSON.errors.email) {
                    $('#register-email').addClass('has-error');
                    aviso += jqXHR.responseJSON.errors.email + '\n';
                }
                if (jqXHR.responseJSON.errors.password) {
                    $('#register-password').addClass('has-error');
                    aviso += jqXHR.responseJSON.errors.password + '\n';
                }
                if (jqXHR.responseJSON.errors.plan) {
                    aviso += jqXHR.responseJSON.errors.plan + '\n';
                }
            } else {
                $('#register-email').addClass('has-error');
                aviso += jqXHR.responseJSON.message + '\n';
            }

            alert(aviso);
            $('#procesando-envio').hide();
        });
    });

    $('#search-form').on('submit', function (e) {
        e.preventDefault();

        $('#procesando-envio').show();
        $('#search-title').removeClass('has-error');
        $('#search-author').removeClass('has-error');
        $('#search-language').removeClass('has-error');
        $('#search-catalog').removeClass('has-error');

        $.ajax({
            url: '/search',
            method: 'get',
            data: $(this).serializeArray()
        }).done(function (data, status) {
            $('#procesando-envio').hide();

            setTimeout(function () {
                alert('OK!');
                $('#search-book').modal('hide');
                $('#search-form')[0].reset();
            }, 1000);
        }).fail(function (jqXHR) {
            alert('Error en llamada AJAX :(');
            $('#procesando-envio').hide();
        });
    });

    $('#password-change-form').on('submit', function (e) {
        e.preventDefault();

        $('#password-email').removeClass('has-error');

        $.ajax({
            url: '/cambiar-password',
            method: 'post',
            data: $(this).serializeArray()
        }).done(function (data, status) {

            setTimeout(function () {
                alert('Comntraseña actualizada éxito!');
                $('#cambio-password').modal('hide');
                $('#password-change-form')[0].reset();
            }, 1000);

        }).fail(function () {
            alert('Error en llamada ajax');
        });
    });
}());
