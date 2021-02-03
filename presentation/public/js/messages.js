/* global Swal */

function successMessage(controllerName) {
    Swal.fire({
        icon: 'success',
        title: 'Exitoso',
        text: 'El proceso se completó correctamente',
        showConfirmButton: false,
        timer: 1500
    }).then(function () {
        window.location.replace("?controller=" + controllerName);
    });
}

function errorMessage(message, htmlButton) {
    Swal.fire({
        icon: 'error',
        title: '¡Ha ocurrido un error!',
        text: message,
        showConfirmButton: true
    }).then(function () {
        addHtmlOnSubmitButton(htmlButton);
    });
}

function confirmDelete() {
    Swal.fire({
        title: '¿Está seguro?',
        text: "Esta acción no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            remove();
        }
    });
}