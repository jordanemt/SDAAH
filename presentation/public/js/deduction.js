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
        showLoaderOnConfirm: true,
        preConfirm: (name) => {
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
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
}

function removeDeduction(id) {
    Swal.fire(confirmMessage()).then((result) => {
        if (result.isConfirmed) {
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
                }
            });
        }
    });
}