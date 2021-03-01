function getPositionEmployee() {
    var url = "/employee/get";
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        data: {"id": $("#idEmployee").val()},
        success: function (data) {
            setEmployeeData(JSON.parse(data));
        },
        error: function (error) {
            errorMessage("No se pudo recuperar la información del empleado: " + error.responseText);
        }
    });
}

function setEmployeeData(employee) {
    var position = employee.position;

    $("#completeName").val(employee.firstLastName + " " + employee.secondLastName + " " + employee.name);
    $("#admissionDate").val(employee.admissionDate);
    $("#position").val(position.type);
}

function calcVacationAccrued() {
    if ($("#idEmployee").val() == null) {
        return 0;
    }

    var url = "/vacation/calcVacationAccrued";
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        data: $("#form").serialize(),
        success: function (data) {
            loadSalary(JSON.parse(data));
        },
        error: function (error) {
            errorMessage("No se pudo recuperar la información del empleado: " + error.responseText);
        }
    });
}

function loadSalary(data) {
    jQuery.each(data.accrueding, function (key, value) {
        $("#accruing" + key).val("₡" + value.toFixed(2));
    });
    
    $("#avgSalary").val("₡" + data.avgSalary.toFixed(2));
    $("#daysTotal").val(data.daysTotal);
    $("#salaryTotal").val("₡" + data.salaryTotal.toFixed(2));
    $("#accruedVacation").val("₡" + data.accruedVacation.toFixed(2));
    $("#workerCCSS").val("₡" + data.workerCCSS.toFixed(2));
    $("#incomeTax").val("₡" + data.incomeTax.toFixed(2));
    $("#deductionsTotal").val("₡" + data.deductionsTotal.toFixed(2));
    if (data.net >= 0) {
        $("#net").val("₡" + data.net.toFixed(2));
    } else {
        errorMessage("Neto a pagar inferior a cero");
        $("#net").val(0.0);
    }
}