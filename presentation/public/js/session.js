/* global Swal */

function login() {
    var url = "?controller=Session&action=login";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        success: function () {
            successMessage('Index');
        },
        error: function (error) {
            errorMessage(error.responseText, 'Index');
        }
    });
}

function logout() {
    var url = "?controller=Session&action=logout";
    Swal.fire({
        title: '¿Está seguro?',
        text: "¿Desea cerrar la sesión?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                success: function () {
                    window.location.replace("?controller=Index");
                },
                error: function (error) {
                    errorMessage(error.responseText, 'Index');
                }
            });
        }
    });
}