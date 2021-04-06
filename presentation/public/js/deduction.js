/* global Swal, fetch */

function insertDeduction() {
    Swal.fire({
        title: 'Inserte el nombre',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Insertar',
        cancelButtonText: 'Cancelar',
        preConfirm: (name) => {
            loadingMessage();
            let url = '?controller=deduction&action=insert';

            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {
                    'name': name
                },
                success: function () {
                    successMessage('deduction');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                    addHtmlOnSubmitButton('<i class="fa fa-folder-plus"></i> Insertar');
                }
            });
        }
    });
}

function removeDeduction(id) {
    Swal.fire(confirmMessage()).then((result) => {
        if (result.isConfirmed) {
            loadingMessage();
            
            let url = '?controller=deduction&action=remove';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {'id': id},
                success: function () {
                    successMessage('deduction');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                    addHtmlOnSubmitButton('<i class="fa fa-folder-plus"></i> Insertar');
                }
            });
        }
    });
}