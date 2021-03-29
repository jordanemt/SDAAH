/* global Swal, fetch */

function updateParam(id) {
    Swal.fire({
        title: 'Inserte el porcentaje',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        customClass: {
            input: 'sweetPercentageMask'
        },
        showCancelButton: true,
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (percentaje) => {
            let url = '?controller=param&action=update';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {
                    'id': id,
                    'percentage': percentaje
                },
                success: function () {
                    successMessage('param');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
    setPercentageMaskOnElement('.sweetPercentageMask');
}
