function calcLiquidation() {
    if ($("#idEmployee").val() == null) {
        return 0;
    }

    var url = "/liquidation/calcLiquidation";
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        data: $("#form").serialize(),
        success: function (data) {
            alert(data);
            loadLiquidation(JSON.parse(data));
        },
        error: function (error) {
            errorMessage("No se pudo recuperar la información del empleado: " + error.responseText);
        }
    });
}

function loadLiquidation(data) {
    jQuery.each(data.vacations.accrueding, function (key, value) {
        $("#accruing" + key).val("₡" + value.toFixed(2));
    });
    
    $("#avgSalaryVacation").val("₡" + data.vacations.avgSalary.toFixed(2));
    $("#daysTotalVacation").val(data.vacations.daysTotal);
    $("#salaryTotalVacation").val("₡" + data.vacations.salaryTotal.toFixed(2));
    $("#accruedVacation").val("₡" + data.vacations.accruedVacation.toFixed(2));
    $("#workerCCSS").val("₡" + data.vacations.workerCCSS.toFixed(2));
    $("#incomeTax").val("₡" + data.vacations.incomeTax.toFixed(2));
    $("#deductionsTotal").val("₡" + data.vacations.deductionsTotal.toFixed(2));
    $("#netVacation").val("₡" + data.vacations.net.toFixed(2));
    
    jQuery.each(data.preCen.accrueding, function (key, value) {
        $("#accruing" + (key + 6)).val("₡" + value.toFixed(2));
    });
    
    $("#avgSalaryPreCen").val("₡" + data.preCen.avgSalary.toFixed(2));
    $("#daysTotalPreCen").val(data.preCen.daysTotal);
    $("#salaryTotalPreCen").val("₡" + data.preCen.salaryTotal.toFixed(2));
    $("#totalPre").val("₡" + data.preCen.totalPre.toFixed(2));
    $("#totalCen").val("₡" + data.preCen.totalCen.toFixed(2));
    if (data.preCen.net > 0) {
        $("#totalPreCen").val("₡" + data.preCen.net.toFixed(2));
    } else {
        $("#totalPreCen").val("₡" + 0.0);
    }
    
    $("#totalSalariesBonus").val("₡" + data.bonus.accruing.toFixed(2));
    $("#totalBonus").val("₡" + data.bonus.grossBonus.toFixed(2));
    
    $("#toPay").val("₡" + data.toPay.toFixed(2));
}