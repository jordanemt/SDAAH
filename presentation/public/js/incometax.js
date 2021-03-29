/* global Swal */

function insertIncomeTax() {
    if ($('#form').valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        let url = '?controller=incomeTax&action=insert';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('incomeTax');
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

function removeIncomeTax(id) {
    Swal.fire(confirmMessage()).then((result) => {
        if (result.isConfirmed) {
            let url = '?controller=incomeTax&action=remove';
            addHtmlLoadingSpinnerOnSubmitButton();
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {'id': id},
                success: function () {
                    successMessage('incomeTax');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                    addHtmlOnSubmitButton('<i class="fa fa-folder-plus"></i> Insertar');
                }
            });
        }
    });
}
