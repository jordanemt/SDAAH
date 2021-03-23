/* global Swal */

function message(msg) {
    Swal.fire({
        text: msg
    });
}

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

function successMessageVaucher() {
    Swal.fire({
        icon: 'success',
        title: 'Exitoso',
        text: 'La descarga se realizará automáticamente',
        showConfirmButton: false,
        timer: 1500
    });
}

function errorMessage(message) {
    Swal.fire({
        icon: 'error',
        title: '¡Ha ocurrido un error!',
        text: message,
        showConfirmButton: true
    });
}

function confirmMessage() {
    return {
        title: '¿Está seguro?',
        text: "Esta acción no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    };
}