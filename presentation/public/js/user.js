/* global Swal */

function insert() {
    if ($("#form").valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        var url = "?controller=User&action=insert";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("User");
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

        var url = "?controller=User&action=update";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("User");
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
    var url = "?controller=User&action=remove";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: {"id": id},
        success: function () {
            successMessage("User");
        },
        error: function (error) {
            errorMessage(error.responseText);

        }
    });
}