/* global Swal */

function insert() {
    if ($("#form").valid()) {
        addHtmlLoadingSpinnerOnSubmitButton();

        var url = "/employee/insert";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("Employee");
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

        var url = "/employee/update";
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: $("#form").serialize(),
            success: function () {
                successMessage("Employee");
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
    var url = "/employee/remove";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: {"id": id},
        success: function () {
            successMessage("Employee");
        },
        error: function (error) {
            errorMessage(error.responseText);
        }
    });
}

function updateSelect() {
    type = $("#type").val();

    var url = "/position/getAllByType";
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        data: {
            "type": type
        },
        success: function (data) {
            if (JSON.parse(data).length === 0) {
                $("#idPosition").empty();
                var option = $("<option></option>").attr("disabled", true)
                        .attr("selected", true).text("No se encontraron Puestos del Tipo " + type);
                $("#idPosition").append(option);
                return 0;
            }

            $("#idPosition").empty();
            var option = $("<option></option>").attr("disabled", true).attr("selected", true).text("Seleccione una opción");
            $("#idPosition").append(option);

            var idPosition = $("#idPositionSave").val();
            jQuery.each(JSON.parse(data), function () {
                switch (this.id) {

                    case idPosition:
                        var option = $("<option></option>").attr("value", this.id).attr("selected", true).text(this.codName);
                        $("#idPosition").append(option);
                        break;

                    default:
                        var option = $("<option></option>").attr("value", this.id).text(this.codName);
                        $("#idPosition").append(option);
                        break;

                }
            });
        },
        error: function (error) {
            errorMessage("No se han podido obtener los puestos: " + error.responseText);
        }
    });
}