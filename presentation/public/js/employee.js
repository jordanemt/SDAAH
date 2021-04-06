/* global Swal, getAllByTypePosition */

async function getEmployee(id) {
    let url = '?controller=employee&action=get';
    return await $.ajax({
        url: url,
        type: 'GET',
        cache: false,
        data: {
            'id': id
        }
    });
}

function insertEmployee() {
    if ($('#form').valid()) {
        loadingMessage();

        let url = '?controller=employee&action=insert';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('employee');
            },
            error: function (error) {
                errorMessage(error.responseText);
            }
        });
    } else {
        errorMessage('Campos vacíos o inválidos');
    }
}

function updateEmployee() {
    if ($('#form').valid()) {
        loadingMessage();

        let url = '?controller=employee&action=update';
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: $('#form').serialize(),
            success: function () {
                successMessage('employee');
            },
            error: function (error) {
                errorMessage(error.responseText);
            }
        });
    } else {
        errorMessage('Campos vacíos o inválidos');
    }
}

function removeEmployee(id) {
    Swal.fire(confirmMessage()).then((result) => {
        if (result.isConfirmed) {
            loadingMessage();
            let url = '?controller=employee&action=remove';
            $.ajax({
                url: url,
                type: 'POST',
                cache: false,
                data: {'id': id},
                success: function () {
                    successMessage('employee');
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        }
    });
}

function updateSelectIdPosition() {
    showLoading();
    
    let type = $('#type').val();
    getAllByTypePosition(type).then((result) => {
        let data = JSON.parse(result);
        if (data === null || data.length === 0) {
            $('#idPosition').empty();
            let option = $('<option></option>').attr('disabled', true)
                    .attr('selected', true).text('No se encontraron Puestos del tipo ' + type);
            $('#idPosition').append(option);
            return 0;
        }

        $('#idPosition').empty();
        let option = $('<option></option>').attr('value', this.id).attr('selected', true).attr('disabled', true).text('Seleccione una opción');
        $('#idPosition').append(option);

        var idPosition = $('#idPositionSave').val();
        jQuery.each(data, function () {
            switch (this.id) {

                case idPosition:
                    option = $('<option></option>').attr('value', this.id).attr('selected', true).text(this.cod + ' ' + this.name);
                    $('#idPosition').append(option);
                    break;

                default:
                    option = $('<option></option>').attr('value', this.id).text(this.cod + ' ' + this.name);
                    $('#idPosition').append(option);
                    break;

            }
        });
    }).catch(error => {
        errorMessage(error.responseText);
    }).finally(function () {
        $('#idPosition').valid();
        hideLoading();
    });
}
