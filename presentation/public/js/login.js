/* global Swal */

function login() {
    if ($('#form').valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        var url = '?controller=login&action=login';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('index');
            },
            error: function (error) {
                errorMessage(error.responseText);
                addHtmlOnSubmitButton('Insertar');
            }
        });
    } else {
        errorMessage('Campos vacíos o inválidos');
    }
}

function logout() {
    var url = '?controller=login&action=logout';
    Swal.fire({
        title: '¿Está seguro?',
        text: '¿Desea cerrar la sesión?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                success: function () {
                    window.location.replace('?controller=index');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        }
    });
}