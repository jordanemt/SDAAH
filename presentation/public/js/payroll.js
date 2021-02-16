/* global Swal */

function submitSearch() {
    $('#search').submit();
}

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

//function update() {
//    addHtmlLoadingSpinnerOnSubmitButton();
//    successMessage("Payroll");
//}

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
    var url = "/employee/getPositionEmployee";
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

function setSalaryOptions(position) {
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

    $("#location").val(position.location);
    $("#type").val(position.type);
    $("#salary").val("₡" + position.salary);
}


function addDeductions() {
    switchVisibilityToHide($(".deductions"));
    $(".deduction-input").attr("disabled", true);
    deductions = String($("#deductions").val()).split(",");
    jQuery.each(deductions, function () {
        $("#deduction-form-group-" + this).show();
        $("#deduction-" + this).attr("disabled", false);
    });
}

function setSearchOptions() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    
    var fortnight = urlParams.get('fortnight');
    var year = urlParams.get('year');
    var location = urlParams.get('location');
    
    $('#fortnight option[value="' + fortnight + '"]').prop('selected', true);
    $('#year option[value="' + year + '"]').prop('selected', true);
    $('#location option[value="' + location + '"]').prop('selected', true);
    
    $('.selectpicker').selectpicker('refresh');
}

$(document).ready(function () {

});