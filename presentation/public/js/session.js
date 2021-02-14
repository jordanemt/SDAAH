/* global Swal */

function login() {
    var url = "/session/login";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        success: function () {
            successMessage('index');
        },
        error: function (error) {
            errorMessage(error.responseText);
        }
    });
}

function logout() {
    var url = "/session/logout";
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
                    window.location.replace("/index");
                },
                error: function (error) {
                    errorMessage(error.responseText);
                }
            });
        }
    });
}