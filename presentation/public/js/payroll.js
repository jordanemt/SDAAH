/* global Swal, getEmployee */

function insertPayroll() {
    if ($('#form').valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        let url = '?controller=payroll&action=insert';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('payroll');
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

function updatePayroll() {
    if ($('#form').valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        let url = '?controller=payroll&action=update';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('payroll');
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

function removePayroll(id) {
    Swal.fire(confirmMessage()).then((result) => {
        if (result.isConfirmed) {
            let url = '?controller=payroll&action=remove';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {'id': id},
                success: function () {
                    successMessage('payroll');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        }
    });
}

function chargeEmployeeDataOnPayroll() {
    let id = $('#idEmployee').val();
    getEmployee(id).then((result) => {
        let employee = JSON.parse(result);
        let position = employee.position;

        switch (position.type) {
            case 'Mensual' :
                $('#workingDays').attr('disabled', false);
                $('#ordinaryTimeHours').attr('disabled', true);
                break;

            case 'Diario' :
                $('#workingDays').attr('disabled', true);
                $('#ordinaryTimeHours').attr('disabled', false);
                break;
        }

        $('#location').val(employee.location);
        $('#position').val(position.name);
        $('#type').val(position.type);
        $('#salary').val('₡' + position.salary);
    }).catch(error => {
        errorMessage(error.responseText);
    });
}
