function overwriteJQueryMessages() {
    jQuery.extend(jQuery.validator.messages, {
        required: 'Este campo es necesario',
        remote: 'Please fix this field',
        email: 'Ingrese un correo válido',
        url: 'Please enter a valid URL',
        date: 'Please enter a valid date',
        dateISO: 'Please enter a valid date (ISO)',
        number: 'Solo se permiten números',
        digits: 'Please enter only digits',
        creditcard: 'Please enter a valid credit card number',
        equalTo: 'Please enter the same value again',
        accept: 'Please enter a value with a valid extension',
        maxlength: jQuery.validator.format('Please enter no more than {0} characters'),
        minlength: jQuery.validator.format('Por favor ingrese al menos {0} carácteres'),
        rangelength: jQuery.validator.format('Please enter a value between {0} and {1} characters long'),
        range: jQuery.validator.format('Please enter a value between {0} and {1}'),
        max: jQuery.validator.format('Ingrese un valor menor o igual a {0}'),
        min: jQuery.validator.format('Ingrese un valor mayor o igual a {0}')
    });
}

function chargeDataTable(element) {
    $(element).DataTable({
        language: {
            lengthMenu: 'Mostrando _MENU_ registros',
            zeroRecords: 'No hay registros',
            info: 'Mostrando página _PAGE_ de _PAGES_',
            infoEmpty: 'No hay registros',
            infoFiltered: '(filtrado de _MAX_ registros)',
            search: 'Buscar:',
            paginate: {
                first: 'Inicio',
                last: 'Final',
                next: 'Siguiente',
                previous: 'Anterior'
            }
        }
    });
}

function resetForm(element) {
    $(element).trigger('reset');
}

function addHtmlLoadingSpinnerOnSubmitButton() {
    var html = '<i class=\'fa fa-spinner fa-spin\'></i> Cargando...';
    $('#submit-button').attr('disabled', 'true');
    $('#submit-button').html(html);
}

function addHtmlOnSubmitButton(html) {
    $('#submit-button').removeAttr('disabled');
    $('#submit-button').html(html);
}

function switchVisibility(element) {
    if ($(element).is(':visible')) {
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

function switchDisabled(element) {
    if ($(element).is(':disabled')) {
        $(element).attr('disabled', false);
    } else {
        $(element).attr('disabled', true);
    }
}

function chargeValidInput() {
    $('input').focusout(function () {
        if (this.value !== '') {
            $(this).valid();
        }
    });
}

function setMoneyMaskOnElement(element) {
    $(element).mask('# ##0.00', {
        reverse: true,
        placeholder: '0.00'
    });
}

function setMask() {
    $('.numberMask').mask('#', {
        placeholder: '0'
    });
    $('.cardMask').mask('000000000', {
        placeholder: '000000000'
    });
    $('.accountMask').mask('000000000000000', {
        placeholder: '000000000000000'
    });
    $('.fourDigitsMask').mask('0000', {
        placeholder: '0000'
    });
    $('.textMask').mask('s', {
        placeholder: 'Ingrese lo que se le solicita',
        translation: {
            's': {
                pattern: /[A-Za-zÀ-ÿ ]/,
                recursive: true
            }
        }
    });
    setMoneyMaskOnElement('.moneyMask');
}

function submitSearch() {
    $('#search').submit();
}

function addDeductions() {
    switchVisibilityToHide($('.deductions'));
    $('.deduction-input').attr('disabled', true);
    deductions = String($('#deductions').val()).split(',');
    jQuery.each(deductions, function () {
        $('#deduction-form-group-' + this).show();
        $('#deduction-' + this).attr('disabled', false);
    });
}

$(document).ready(function () {
    $('body').removeClass('d-none');
    resetForm('form');
    chargeDataTable('.table');
    overwriteJQueryMessages();
    chargeValidInput();
    setMask();
});