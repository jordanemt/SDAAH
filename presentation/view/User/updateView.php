<?php
$vars["viewName"] = 'user';
include_once 'presentation/public/header.php';
?>

<script src="/presentation/public/js/user.js" type="text/javascript"></script>

<div class="container my-4">

    <div class="card">

        <div class="card-header text-center">
            <h2>Actualizar Usuario</h2>
        </div>

        <div class="card-body">

            <a href="/user"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form" enctype="multipart/form-data">
                <div class="form-group d-none">
                    <input type="number" class="form-control" id="id" name="id" value="<?= $vars['data']['id']; ?>">
                </div>
                
                <div class="form-group">
                    <label for="card">Cédula</label>
                    <input type="text" class="form-control cardMask" id="card" name="card" minlength="9" maxlength="9" value="<?= $vars['data']['card']; ?>" readonly required>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_changed_password" name="is_changed_password" onchange="switchVisibility('#changePassword-container')" value="1">
                        <label class="form-check-label" for="defaultCheck1">
                            Cambiar Contraseña
                        </label>
                    </div>
                </div>

                <div id="changePassword-container" class="form-row"> <script>switchVisibilityToHide('#changePassword-container')</script>
                    <div class="form-group col-md-6">
                        <label for="pass">Nueva Contraseña</label>
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
                        <input type="text" class="form-control textMask" id="firstLastName" name="firstLastName" maxlength="25" value="<?= $vars['data']['firstLastName']; ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="secondLastName">Segundo apellido</label>
                        <input type="text" class="form-control textMask" id="secondLastName" name="secondLastName" maxlength="25" value="<?= $vars['data']['secondLastName']; ?>" required>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control textMask" id="name" name="name" maxlength="50" value="<?= $vars['data']['name']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="100" placeholder="Ingrese lo que se le solicita" value="<?= $vars['data']['email']; ?>" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="role">Rol</label>
                        <select class="form-control" id="role" name="role" required>
                            <option disabled>Seleccione una opción</option>
                            <option <?php if ($vars['data']['role'] == 1) { echo 'selected'; } ?> value="1">Consultor</option>
                            <option <?php if ($vars['data']['role'] == 2) { echo 'selected'; } ?> value="2">Digitador</option>
                            <option <?php if ($vars['data']['role'] == 3) { echo 'selected'; } ?> value="3">Administrador</option>
                        </select>
                    </div>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="update();">Actualizar</button>
            </form>

            <hr>

            <a href="/user"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
