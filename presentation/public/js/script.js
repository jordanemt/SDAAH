function overwriteJQueryMessages() {
    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es necesario",
        remote: "Please fix this field",
        email: "Ingrese un correo válido",
        url: "Please enter a valid URL",
        date: "Please enter a valid date",
        dateISO: "Please enter a valid date (ISO)",
        number: "Solo se permiten números",
        digits: "Please enter only digits",
        creditcard: "Please enter a valid credit card number",
        equalTo: "Please enter the same value again",
        accept: "Please enter a value with a valid extension",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters"),
        minlength: jQuery.validator.format("Por favor ingrese al menos {0} carácteres"),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long"),
        range: jQuery.validator.format("Please enter a value between {0} and {1}"),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}"),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}")
    });
}

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

function chargeValidInput() {
    $("input").focusout(function () {
        if (this.value !== "") {
            $(this).valid();
        }
    });
}

function setMask() {
    $(".numberMask").mask('#');
    $(".textMask").mask("s", {
        translation: {
            's': {
                pattern: /[A-Za-zÀ-ÿ]/,
                recursive: true
            }
        }
    });
    $(".moneyMask").mask("# ##0,00", {reverse: true});
}

$(document).ready(function () {
    $("body").removeClass("d-none");
    resetForm("form");
    chargeDataTable("table");
    overwriteJQueryMessages();
    chargeValidInput();
    setMask();
});