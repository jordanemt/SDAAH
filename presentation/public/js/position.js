/* global Swal */

function insert() {
    if ($("#form").valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        var url = "/position/insert";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("position");
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

        var url = "/position/update";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("position");
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
    var url = "/position/remove";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: {"id": id},
        success: function () {
            successMessage("position");
        },
        error: function (error) {
            errorMessage(error.responseText);
        }
    });
}