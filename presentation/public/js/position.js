/* global Swal */

async function getAllByTypePosition(type) {
    let url = '?controller=position&action=getAllByType';
    return await $.ajax({
        url: url,
        type: 'GET',
        cache: false,
        data: {
            'type': type
        }
    });
}

function insertPosition() {
    if ($('#form').valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        let url = '?controller=position&action=insert';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('position');
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

function updatePosition() {
    if ($('#form').valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        let url = '?controller=position&action=update';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('position');
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

function removePosition(id) {
    Swal.fire(confirmMessage()).then((result) => {
        if (result.isConfirmed) {
            let url = '?controller=position&action=remove';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {'id': id},
                success: function () {
                    successMessage('position');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        }
    });
}