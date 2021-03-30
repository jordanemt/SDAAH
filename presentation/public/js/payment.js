/* global Swal, getEmployee */

function insertPayment() {
    if ($('#form').valid()) {
        loadingMessage();

        let url = '?controller=payment&action=insert';
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
            }
        });
    } else {
        errorMessage('Campos vacíos o inválidos');
    }
}

function updatePayment() {
    if ($('#form').valid()) {
        loadingMessage();

        let url = '?controller=payment&action=update';
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
                showLoading();
            }
        });
    } else {
        errorMessage('Campos vacíos o inválidos');
    }
}

function removePayment(id) {
    Swal.fire(confirmMessage()).then((result) => {
        if (result.isConfirmed) {
            loadingMessage();
            
            let url = '?controller=payment&action=remove';
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

function chargeEmployeeDataOnPayment() {
    let id = $('#idEmployee').val();
    showLoading();
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

        $('#form').valid();
    }).catch(error => {
        errorMessage(error.responseText);
    }).finally(function() {
        hideLoading();
    });
}

function showAccruedDetails(id) {
    loadingMessage();
    
    let url = '?controller=payment&action=get';
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        data: {
            id: id
        },
        success: function (res) {
            let data = JSON.parse(res);
            Swal.fire({
                title: 'Detalle Devengando',
                icon: 'info',
                html:
                        '<table class="table table-bordered nowrap">' +
                        '<tr><td>Ordinario</td><td>₡' + data.ordinary + '</td></tr>' +
                        '<tr><td>Vacación</td><td>₡' + data.vacationAmount + '</td></tr>' +
                        '<tr><td>Extra</td><td>₡' + data.extra + '</td></tr>' +
                        '<tr><td>Doble</td><td>₡' + data.double + '</td></tr>' +
                        '<tr><td>Recargo</td><td>₡' + data.surcharges + '</td></tr>' +
                        '<tr><td>Bono Salarial</td><td>₡' + data.salaryBonus + '</td></tr>' +
                        '<tr><td>Incentivos</td><td>₡' + data.incentives + '</td></tr>' +
                        '<tr><td>Maternidad</td><td>₡' + data.maternityAmount + '</td></tr>' +
                        '<tr><th>Total</th><td>₡' + data.gross + '</td></tr>' +
                        '</table>'
            });
        },
        error: function (error) {
            errorMessage('Error al obtener la información: ' + error.responseText);
        }
    });
}

function showDeductionsDetails(id) {
    loadingMessage();
    
    let url = '?controller=payment&action=get';
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        data: {
            id: id
        },
        success: function (res) {
            let data = JSON.parse(res);
            
            let html = '<table class="table table-bordered nowrap">';
            html += '<tr><td>Seguro Social</td><td>₡' + data.workerCCSS + '</td></tr>';
            html += '<tr><td>Imp. Renta</td><td>₡' + data.incomeTax + '</td></tr>';
            jQuery.each(data.deductions, function () {
                html += '<tr><td>' + this.name + '</td><td>₡ ' + this.mount + '</td></tr>';
            });
            html += '<tr><th>Total</th><td>₡' + data.deductionsTotal + '</td></tr>';
            html += '</table>';
            
            Swal.fire({
                title: 'Detalle Deducciones',
                icon: 'info',
                html: html
            });
        },
        error: function (error) {
            errorMessage('Error al obtener la información: ' + error.responseText);
        }
    });
}

function showDisabilitiesDetails(id) {
    loadingMessage();
    
    let url = '?controller=payment&action=get';
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        data: {
            id: id
        },
        success: function (res) {
            let data = JSON.parse(res);
            Swal.fire({
                title: 'Detalle Incapacidades',
                icon: 'info',
                html:
                        '<table class="table table-bordered nowrap">' +
                        '<tr><td>CCSS</td><td>₡' + data.ccssAmount + '</td></tr>' +
                        '<tr><td>INS</td><td>₡' + data.insAmount + '</td></tr>' +
                        '<tr><th>Total</th><td>₡' + (parseFloat(data.ccssAmount) + parseFloat(data.insAmount)).toFixed(2) + '</td></tr>' +
                        '</table>'
            });
        },
        error: function (error) {
            errorMessage('Error al obtener la información: ' + error.responseText);
        }
    });
}
