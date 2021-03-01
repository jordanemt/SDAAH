/* global Swal */
function insert() {
    if ($("#form").valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        var url = "/payroll/insert";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("payroll");
            },
            error: function (error) {
                errorMessage(error.responseText);
                addHtmlOnSubmitButton('Insertar');
            }
        });
    } else {
        errorMessage("Campos vacíos o inválidos");
    }
}

function update() {
    if ($("#form").valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        var url = "/payroll/update";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("payroll");
            },
            error: function (error) {
                errorMessage(error.responseText);
                addHtmlOnSubmitButton('Actualizar');
            }
        });
    } else {
        errorMessage("Campos vacíos o inválidos");
    }
}

function remove(id) {
    var url = "/payroll/remove";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: {"id": id},
        success: function () {
            successMessage("payroll");
        },
        error: function (error) {
            errorMessage(error.responseText);
        }
    });
}

function getPositionEmployee() {
    var url = "/employee/get";
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        data: {"id": $("#idEmployee").val()},
        success: function (data) {
            setSalaryOptions(JSON.parse(data));
        },
        error: function (error) {
            errorMessage("No se pudo recuperar la información del empleado: " + error.responseText);
        }
    });
}

function setSalaryOptions(employee) {
    var position = employee.position;
    
    switch (position.type) {
        case "Mensual" :
            $("#workingDays").attr("disabled", false);
            $("#ordinaryTimeHours").attr("disabled", true);
            break;

        case "Diario" :
            $("#workingDays").attr("disabled", true);
            $("#ordinaryTimeHours").attr("disabled", false);
            break;
    }

    $("#location").val(employee.location);
    $("#position").val(position.name);
    $("#type").val(position.type);
    $("#salary").val("₡" + position.salary);
}

$(document).ready(function () {

});