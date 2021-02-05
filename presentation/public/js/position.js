/* global Swal */

function insert() {
    if ($("#form").valid()) {
        $("input").unmask();
        addHtmlLoadingSpinnerOnSubmitButton();

        var url = "?controller=Position&action=insert";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("Position");
            },
            error: function (error) {
                errorMessage(error.responseText);
                addHtmlOnSubmitButton('Insertar');
                setMask();
            }
        });
    } else {
        errorMessage("Campos vacíos o inválidos");
    }
}

function update() {
    if ($("#form").valid()) {
        $("input").unmask();
        addHtmlLoadingSpinnerOnSubmitButton();

        var url = "?controller=Position&action=update";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("Position");
            },
            error: function (error) {
                errorMessage(error.responseText);
                addHtmlOnSubmitButton('Actualizar');
                setMask();
            }
        });
    } else {
        errorMessage("Campos vacíos o inválidos");
    }
}

function remove(id) {
    var url = "?controller=Position&action=remove";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: {"id": id},
        success: function () {
            successMessage("Position");
        },
        error: function (error) {
            errorMessage(error.responseText);
        }
    });
}

function showSalaryOptions() {
    switch ($("#type").val()) {
        case "1" :
            $("#salary").attr("disabled", false);
            $("#ordinaryTime").attr("disabled", true);
            $("#extraTime").attr("disabled", true);
            $("#doubleTime").attr("disabled", true);
            break;

        case "2" :
            $("#salary").attr("disabled", true);
            $("#ordinaryTime").attr("disabled", false);
            $("#extraTime").attr("disabled", false);
            $("#doubleTime").attr("disabled", false);
            break;
    }
}