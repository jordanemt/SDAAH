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
        preConfirm: (mount) => {
            loadingMessage();

            var url = '?controller=employee&action=insertAlimonyOnBonus';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {
                    'idEmployee': idEmployee,
                    'year': $('#year').val(),
                    'mount': mount
                },
                success: function () {
                    successMessage('bonus');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        }
    });
    setMoneyMaskOnElement('.sweetMoneyMask');
}

function updateAlimony(id, val) {
    val = val ? val.toFixed(2) : '';
    Swal.fire({
        title: 'Inserte el monto',
        input: 'text',
        inputValue: val,
        inputAttributes: {
            autocapitalize: 'off'
        },
        customClass: {
            input: 'sweetMoneyMask'
        },
        showCancelButton: true,
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (mount) => {
            loadingMessage();
            
            var url = '?controller=employee&action=updateAlimonyOnBonus';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {
                    'id': id,
                    'mount': mount
                },
                success: function () {
                    successMessage('bonus');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
    setMoneyMaskOnElement('.sweetMoneyMask');
}

$(document).ready(function () {
    var table = $('#bonus-table').DataTable();

    $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();

        var column1 = table.column(3);
        var column2 = table.column(4);
        var column3 = table.column(5);
        var column4 = table.column(6);
        var column5 = table.column(7);
        var column6 = table.column(8);
        var column7 = table.column(9);
        var column8 = table.column(10);
        var column9 = table.column(11);
        var column10 = table.column(12);
        var column11 = table.column(13);
        var column12 = table.column(14);

        column1.visible(!column1.visible());
        column2.visible(!column2.visible());
        column3.visible(!column3.visible());
        column4.visible(!column4.visible());
        column5.visible(!column5.visible());
        column6.visible(!column6.visible());
        column7.visible(!column7.visible());
        column8.visible(!column8.visible());
        column9.visible(!column9.visible());
        column10.visible(!column10.visible());
        column11.visible(!column11.visible());
        column12.visible(!column12.visible());
    });
});