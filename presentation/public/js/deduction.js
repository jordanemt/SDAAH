/* global Swal, fetch */

function insert() {
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
            var url = "/deduction/insert";
            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                data: {
                    "name": name
                },
                success: function () {
                    successMessage("deduction");
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
}

function remove(id) {
    var url = "/deduction/remove";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: {"id": id},
        success: function () {
            successMessage("deduction");
        },
        error: function (error) {
            errorMessage(error.responseText);
        }
    });
}