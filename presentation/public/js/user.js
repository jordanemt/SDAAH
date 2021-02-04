/* global Swal */

function insert() {
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
}

function update() {
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

$(document).ready(function () {
});