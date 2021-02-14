/* global Swal */

function successMessage(controllerName) {
    Swal.fire({
        icon: 'success',
        title: 'Exitoso',
        text: 'El proceso se completó correctamente',
        showConfirmButton: false,
        timer: 1500
    }).then(function () {
        window.location.replace("/" + controllerName);
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

function confirmDelete(id) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "Esta acción no se puede revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            remove(id);
        }
    });
}