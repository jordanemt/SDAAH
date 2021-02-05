<?php
$vars["viewName"] = 'user';
include_once 'presentation/public/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: ?controller=Index');
}
?>

<script src="presentation/public/js/user.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Insertar Usuario</h2>
        </div>

        <div class="card-body">

            <a href="?controller=User"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <div class="form-group d-none">
                    <input type="number" class="form-control" id="id" name="id" value="1">
                </div>

                <div class="form-group">
                    <label for="card">Cédula</label>
                    <input type="text" class="form-control numberMask" id="card" name="card" placeholder="Ingrese lo que se le solicita" minlength="9" maxlength="9" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pass">Contraseña</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Ingrese lo que se le solicita" minlength="6" maxlength="11" required>
                        <small id="passHelp" class="form-text text-muted">Digite entre 6 a 11 carácteres</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="passConfirm">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="passConfirm" name="passConfirm" placeholder="Ingrese lo que se le solicita" minlength="6" maxlength="11" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="firstLastName">Primer apellido</label>
                        <input type="text" class="form-control textMask" id="firstLastName" name="firstLastName" placeholder="Ingrese lo que se le solicita" maxlength="25" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="secondLastName">Segundo apellido</label>
                        <input type="text" class="form-control textMask" id="secondLastName" name="secondLastName" placeholder="Ingrese lo que se le solicita" maxlength="25" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control textMask" id="name" name="name" placeholder="Ingrese lo que se le solicita" maxlength="50" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese lo que se le solicita" maxlength="100" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="role">Rol</label>
                        <select class="form-control" id="role" name="role" required>
                            <option disabled>Seleccione una opción</option>
                            <option selected value="1">Consultor</option>
                            <option value="2">Digitador</option>
                            <option value="3">Administrador</option>
                        </select>
                    </div>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="insert();">Insertar</button>
            </form>

            <hr>

            <a href="?controller=User"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
