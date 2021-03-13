/* global Swal */

function insertUser() {
    if ($('#form').valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        let url = '?controller=user&action=insert';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('user');
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

function updateUser() {
    if ($('#form').valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        let url = '?controller=user&action=update';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('user');
            },
            error: function (error) {
                errorMessage(error.responseText);
                addHtmlOnSubmitButton('Actualizar');
            }
        });
    } else {
        errorMessage('Campos vacíos o inválidos');
    }
}

function removeUser(id) {
    Swal.fire(confirmMessage()).then((result) => {
        if (result.isConfirmed) {
            let url = '?controller=user&action=remove';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {'id': id},
                success: function () {
                    successMessage('user');
                },
                error: function (error) {
                    errorMessage(error.response);
                }
            });
        }
    });
}