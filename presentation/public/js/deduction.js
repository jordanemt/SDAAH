function insert() {
    var name = prompt("Inserte el nombre");
    
    if (name === null) {
        return 0;
    }
    
    var url = "/deduction/insert";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: {
            "name": name
        },
        success: function () {
            successMessage("deduction");
        },
        error: function (error) {
            errorMessage(error.responseText);
            addHtmlOnSubmitButton('Insertar');
        }
    });
}

function remove(id) {
    var url = "/deduction/remove";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: {"id": id},
        success: function () {
            successMessage("deduction");
        },
        error: function (error) {
            errorMessage(error.responseText);
        }
    });
}