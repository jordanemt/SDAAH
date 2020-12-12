function chargeDataTable(element) {
    $(element).DataTable({
        language: {
            "lengthMenu": "Mostrando _MENU_ registros",
            "zeroRecords": "No hay registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": "(filtrado de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Inicio",
                "last": "Final",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
}

function resetForm(element) {
    $(element).trigger("reset");
}

function addHtmlLoadingSpinnerOnSubmitButton() {
    var html = "<i class=\"fa fa-spinner fa-spin\"></i> Cargando...";
    $("#submit-button").attr("disabled", "true");
    $("#submit-button").html(html);
}

function addHtmlOnSubmitButton(html) {
    $("#submit-button").removeAttr("disabled");
    $("#submit-button").html(html);
}

function switchVisibility(element) {
    if ($(element).is(":visible")) {
        $(element).hide();
    } else {
        $(element).show();
    }
}

function switchVisibilityToShow(element) {
    $(element).show();
}

function switchVisibilityToHide(element) {
    $(element).hide();
}

$(document).ready(function () {
    chargeDataTable("table");
    resetForm("form");
});