/* global Swal, fetch */

function updateParam(id, val) {
    val = val ? val : '';
    Swal.fire({
        title: 'Inserte el porcentaje',
        input: 'text',
        inputValue: val,
        inputAttributes: {
            autocapitalize: 'off'
        },
        customClass: {
            input: 'sweetPercentageMask'
        },
        showCancelButton: true,
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar',
        preConfirm: (percentaje) => {
            loadingMessage();
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
        }
    });
    setPercentageMaskOnElement('.sweetPercentageMask');
}
