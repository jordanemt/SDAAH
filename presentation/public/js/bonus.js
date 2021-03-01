/* global Swal */

function insertAlimony(idEmployee) {
    Swal.fire({
        title: 'Inserte el monto',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        customClass: {
            input: 'sweetMoneyMask'
        },
        showCancelButton: true,
        confirmButtonText: 'Insertar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (mount) => {
            var url = "/employee/insertAlimonyOnBonus";
            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                data: {
                    "idEmployee": idEmployee,
                    "year": $("#year").val(),
                    "mount": mount
                },
                success: function () {
                    successMessage("bonus/detail");
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
    setMoneyMaskOnElement(".sweetMoneyMask");
}

function updateAlimony(id) {
    Swal.fire({
        title: 'Inserte el monto',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        customClass: {
            input: 'sweetMoneyMask'
        },
        showCancelButton: true,
        confirmButtonText: 'Insertar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (mount) => {
            var url = "/employee/updateAlimonyOnBonus";
            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                data: {
                    "id": id,
                    "mount": mount
                },
                success: function () {
                    successMessage("bonus/detail");
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
    setMoneyMaskOnElement(".sweetMoneyMask");
}