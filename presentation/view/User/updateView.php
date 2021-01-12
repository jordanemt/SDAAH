<?php

$vars["user-view"] = true;
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/user.js" type="text/javascript"></script>

<div class="container my-4">

    <div class="card">

        <div class="card-header text-center">
            <h2>Actualizar Usuario</h2>
        </div>

        <div class="card-body">

            <a href="?controller=user"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <div class="form-group">
                    <label for="card">Cédula</label>
                    <input type="text" class="form-control" id="card" name="card" placeholder="Ingrese lo que se le solicita" maxlength="30" required>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_changed_password" name="is_changed_password" onchange="switchVisibility('#changePassword-container')">
                        <label class="form-check-label" for="defaultCheck1">
                            Cambiar Contraseña
                        </label>
                    </div>
                </div>

                <div id="changePassword-container" class="form-row"> <script>switchVisibilityToHide('#changePassword-container')</script>
                    <div class="form-group col-md-6">
                        <label for="password">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese lo que se le solicita" maxlength="11" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="passwordConfirm">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="Ingrese lo que se le solicita" maxlength="11" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="firstLastName">Primer apellido</label>
                        <input type="text" class="form-control" id="firstLastName" name="firstLastName" placeholder="Ingrese lo que se le solicita" maxlength="20" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="secondLastName">Segundo apellido</label>
                        <input type="text" class="form-control" id="secondLastName" name="secondLastName" placeholder="Ingrese lo que se le solicita" maxlength="20" required>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese lo que se le solicita" maxlength="40" required>
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
                            <option selected disabled>Seleccione una opción</option>
                            <option value="1">Consultor</option>
                            <option value="2">Digitador</option>
                            <option value="3">Administrador</option>
                        </select>
                    </div>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="update()();">Actualizar</button>
            </form>

            <hr>

            <a href="?controller=user"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
