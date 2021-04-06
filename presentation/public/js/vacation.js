/* global getEmployee */

function chargeEmployeeDataOnVacation() {
    showLoading();
    let id = $('#idEmployee').val();
    getEmployee(id).then((result) => {
        let employee = JSON.parse(result);
        let position = employee.position;

        $('#card').val(employee.card);
        $('#completeName').val(employee.firstLastName + ' ' + employee.secondLastName + ' ' + employee.name);
        $('#admissionDate').val(employee.admissionDate);
        $('#position').val(position.name);
        hideLoading();
        calcVacationAccrued();
    }).catch(error => {
        errorMessage(error.responseText);
        hideLoading();
    });
}

function calcVacationAccrued() {
    if ($('#idEmployee').val() === null) {
        return 0;
    }
    
    showCalculatingLoading();
    let url = '?controller=vacation&action=calcVacationAccrued';
    return $.ajax({
        url: url,
        type: 'GET',
        cache: false,
        data: $('#formVacation').serialize(),
        success: function (result) {
            let data = JSON.parse(result);

            jQuery.each(data.accrueding, function (key, value) {
                $('#accruing' + key).val(value.toFixed(2));
            });

            $('#avgSalary').val(data.avgSalary.toFixed(2));
            $('#daysTotal').val(data.daysTotal);
            $('#salaryTotal').val(data.salaryTotal.toFixed(2));
            $('#accruedVacation').val(data.accruedVacation.toFixed(2));
            $('#workerCCSS').val(data.workerCCSS.toFixed(2));
            $('#incomeTax').val(data.incomeTax.toFixed(2));
            $('#deductionsTotal').val(data.deductionsTotal.toFixed(2));
            if (data.net >= 0) {
                $('#net').val(data.net.toFixed(2));
            } else {
                errorMessage('Neto a pagar inferior a cero');
                $('#net').val(0.0);
            }
            
            $('#formVacation').valid();
            hideCalculatingLoading();
        },
        error: function (error) {
            errorMessage('No se pudo recuperar la información del empleado: ' + error.responseText);
            hideCalculatingLoading();
        }
    });
}

function setActiveOnchangeVacation() {
    $('select.active-onchange-vacation').change(function () {
        calcVacationAccrued();
    });
    
    $('input.active-onchange-vacation').keyup(function () {
        calcVacationAccrued();
    });
}

function dowloadVacationVaucher() {
    if ($('#formVacation').valid()) {
        successMessageVaucher();
        let url = '?controller=vacation&action=vaucher&';
        window.location = url + $('#formVacation').serialize();
        
    } else {
        errorMessage('Campos vacíos o inválidos');
    }
}

$(document).ready(function () {
    setActiveOnchangeVacation();
});