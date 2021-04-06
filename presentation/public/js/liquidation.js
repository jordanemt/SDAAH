/* global getEmployee */

function calcRecord() {
    if ($('#admissionDate').val() == null) {
        return 0;
    }

    let a = moment($('#departureDate').val());
    let b = moment($('#admissionDate').val());

    let years = a.diff(b, 'year');
    b.add(years, 'years');

    let months = a.diff(b, 'months');
    b.add(months, 'months');

    let days = a.diff(b, 'days');

    $('#record').val(years + ' años, ' + months + ' meses, ' + days + ' días');
}

function chargeEmployeeDataOnLiquidation() {
    let id = $('#idEmployee').val();
    showLoading();
    getEmployee(id).then((result) => {
        let employee = JSON.parse(result);

        $('#completeName').val(employee.firstLastName + ' ' + employee.secondLastName + ' ' + employee.name);
        $('#admissionDate').val(employee.admissionDate);
        $('#card').val(employee.card);
        $('#position').val(employee.position.name);
        calcRecord();
        hideLoading();
        calcLiquidation();
    }).catch(error => {
        hideLoading();
        errorMessage('Error al recuperar información del empleado: ' + error.responseText);
    });
}

function calcLiquidation() {
    if ($('#idEmployee').val() == null) {
        return 0;
    }

    showCalculatingLoading();
    var url = '?controller=liquidation&action=calcLiquidation';
    $.ajax({
        url: url,
        type: 'GET',
        cache: false,
        data: $('#formLiquidation').serialize(),
        success: function (data) {
            loadLiquidation(JSON.parse(data));
            hideCalculatingLoading();
        },
        error: function (error) {
            errorMessage(error);
        }
    });
}

function loadLiquidation(data) {
    jQuery.each(data.vacations.accrueding, function (key, value) {
        $('#accruing' + key).val(value.toFixed(2));
    });

    $('#avgSalaryVacation').val(data.vacations.avgSalary.toFixed(2));
    $('#daysTotalVacation').val(data.vacations.daysTotal);
    $('#salaryTotalVacation').val(data.vacations.salaryTotal.toFixed(2));
    $('#accruedVacation').val(data.vacations.accruedVacation.toFixed(2));
    $('#workerCCSS').val(data.vacations.workerCCSS.toFixed(2));
    $('#incomeTax').val(data.vacations.incomeTax.toFixed(2));
    $('#deductionsTotal').val(data.vacations.deductionsTotal.toFixed(2));
    $('#netVacation').val(data.vacations.net.toFixed(2));
    
    if (data.vacations.net >= 0) {
        $('#netVacation').val(data.vacations.net.toFixed(2));
    } else {
        errorMessage('Neto Vacac. Proporcionales inferior a cero');
        $('#netVacation').val(0.0);
    }


    jQuery.each(data.preCen.accrueding, function (key, value) {
        $('#accruing' + (key + 6)).val(value.toFixed(2));
    });

    $('#avgSalaryPreCen').val(data.preCen.avgSalary.toFixed(2));
    $('#daysTotalPreCen').val(data.preCen.daysTotal);
    $('#salaryTotalPreCen').val(data.preCen.salaryTotal.toFixed(2));
    $('#totalPre').val(data.preCen.totalPre.toFixed(2));
    $('#totalCen').val(data.preCen.totalCen.toFixed(2));
    if (data.preCen.net > 0) {
        $('#totalPreCen').val(data.preCen.net.toFixed(2));
    } else {
        $('#totalPreCen').val(0.0);
    }

    $('#totalSalariesBonus').val(data.bonus.accruing.toFixed(2));
    $('#totalBonus').val(data.bonus.grossBonus.toFixed(2));

    if (data.toPay >= 0) {
        $('#toPay').val(data.toPay.toFixed(2));
    } else {
        errorMessage('Prestaciones a pagar inferior a cero');
        $('#toPay').val(0.0);
    }

    $('#formLiquidation').valid();
}

function setActiveOnchangeLiquidation() {
    $('select.active-onchange-liquidation').change(function () {
        calcLiquidation();
    });
    
    $('input.active-onchange-liquidation').keyup(function () {
        calcLiquidation();
    });
}

function dowloadLiquidationVaucher() {
    if ($('#formLiquidation').valid()) {
        successMessageVaucher();
        let url = '?controller=liquidation&action=vaucher&';
        window.location = url + $('#formLiquidation').serialize();
    } else {
        errorMessage('Campos vacíos o inválidos');
    }
}

$(document).ready(function () {
    setActiveOnchangeLiquidation();
});