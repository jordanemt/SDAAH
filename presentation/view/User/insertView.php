<?php
$vars["viewName"] = 'user';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Insertar Usuario</h2>
        </div>

        <div class="card-body">

            <a href="?controller=user"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <div class="form-group">
                    <label for="card">Cédula</label>
                    <input type="text" class="form-control cardMask" id="card" name="card" minlength="9" maxlength="9" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pass">Contraseña</label>
                        <input type="password" class="form-control" id="pass" name="pass" minlength="6" maxlength="11" placeholder="Ingrese lo que se le solicita" required>
                        <small id="passHelp" class="form-text text-muted">Digite entre 6 a 11 carácteres</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="passConfirm">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="passConfirm" name="passConfirm" minlength="6" maxlength="11" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="firstLastName">Primer apellido</label>
                        <input type="text" class="form-control textMask" id="firstLastName" name="firstLastName" maxlength="25" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="secondLastName">Segundo apellido</label>
                        <input type="text" class="form-control textMask" id="secondLastName" name="secondLastName" maxlength="25" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control textMask" id="name" name="name" maxlength="50" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="100" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="role">Rol</label>
                        <select class="form-control" id="role" name="role" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="1">Consultor</option>
                            <option value="2">Digitador</option>
                            <option value="3">Administrador</option>
                        </select>
                    </div>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="insertUser();">Insertar</button>
            </form>

            <hr>

            <a href="?controller=user"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
