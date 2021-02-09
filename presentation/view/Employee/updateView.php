<?php

$vars["viewName"] = 'employee';
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/employee.js" type="text/javascript"></script>

<div class="container my-4">

    <div class="card">

        <div class="card-header text-center">
            <h2>Actualizar Empleado</h2>
        </div>

        <div class="card-body">

            <a href="?controller=Employee"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">

                <h4>Datos Personales</h4>

                <div class="form-group d-none">
                    <input type="number" class="form-control" id="id" name="id" value="<?php echo $vars['data']['id'] ?>">
                </div>
                
                <div class="form-group d-none">
                    <input type="number" class="form-control" id="idPositionSave" value="<?php echo $vars['data']['idPosition'] ?>">
                </div>

                <div class="form-group">
                    <label for="card">Cédula</label>
                    <input type="text" class="form-control numberMask" id="card" name="card" placeholder="Ingrese lo que se le solicita" minlength="9" maxlength="9" value="<?php echo $vars['data']['card'] ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="firstLastName">Primer apellido</label>
                        <input type="text" class="form-control textMask" id="firstLastName" name="firstLastName" placeholder="Ingrese lo que se le solicita" maxlength="25" value="<?php echo $vars['data']['firstLastName'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="secondLastName">Segundo apellido</label>
                        <input type="text" class="form-control textMask" id="secondLastName" name="secondLastName" placeholder="Ingrese lo que se le solicita" maxlength="25" value="<?php echo $vars['data']['secondLastName'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control textMask" id="name" name="name" placeholder="Ingrese lo que se le solicita" maxlength="50" value="<?php echo $vars['data']['name'] ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="gender">Sexo</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option disabled>Seleccione una opción</option>
                            <option <?php if ($vars['data']['gender'] == 'Masculino') { echo 'selected'; } ?> value="Masculino">Masculino</option>
                            <option <?php if ($vars['data']['gender'] == 'Femenino') { echo 'selected'; } ?> value="Femenino">Femenino</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="birthdate">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Ingrese lo que se le solicita" value="<?php echo $vars['data']['birthdate'] ?>" required>
                    </div>
                </div>

                <h4>Datos Laborales</h4>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="type">Tipo</label>
                        <select class="form-control" id="type" name="type" onchange="updateSelect();" required>
                            <option disabled>Seleccione una opción</option>
                            <option <?php if ($vars['data']['position']['type'] == 'Mensual') { echo 'selected'; } ?> value="Mensual">Mensual</option>
                            <option <?php if ($vars['data']['position']['type'] == 'Diario') { echo 'selected'; } ?> value="Diario">Diario</option>
                        </select>
                    </div>

                    <div id="position-container" class="form-group col-md-6">
                        <label for="idPosition">Puesto</label>
                        <select class="form-control" id="idPosition" name="idPosition" required>
                            <option selected disabled>Debe seleccionar un Tipo</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="location">Localidad</label>
                        <select class="form-control" id="location" name="location" required>
                            <option disabled>Seleccione una opción</option>
                            <option <?php if ($vars['data']['location'] == 'Administrativo') { echo 'selected'; } ?> value="Administrativo">Administrativo</option>
                            <option <?php if ($vars['data']['location'] == 'Operativo') { echo 'selected'; } ?> value="Operativo">Operativo</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="admissionDate">Fecha de Ingreso</label>
                        <input type="date" class="form-control" id="admissionDate" name="admissionDate" placeholder="Ingrese lo que se le solicita" value="<?php echo $vars['data']['admissionDate'] ?>" required>
                    </div>
                </div>

                <h4>Banco y Contacto</h4>

                <div class="form-group">
                    <label for="bankAccount">Número de Cuenta Bancaria</label>
                    <input type="text" class="form-control numberMask" id="bankAccount" name="bankAccount" placeholder="Ingrese lo que se le solicita" minlength="15" maxlength="15" value="<?php echo $vars['data']['bankAccount'] ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese lo que se le solicita" maxlength="100" value="<?php echo $vars['data']['email'] ?>" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cssIns">CSS/INS</label>
                        <input type="text" class="form-control numberMask" id="cssIns" name="cssIns" placeholder="Ingrese lo que se le solicita" minlength="4" maxlength="4" value="<?php echo $vars['data']['cssIns'] ?>" required>
                    </div>
                </div>

                <div class="form-group">            
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="isAffiliated" name="isAffiliated" <?php if ($vars['data']['isAffiliated']) { echo 'checked'; } ?> value="1">
                        <label class="form-check-label" for="isAffiliated">
                            Afiliado
                        </label>
                    </div>
                </div>


                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="isLiquidated" name="isLiquidated" <?php if ($vars['data']['isLiquidated']) { echo 'checked'; } ?> value="1" onchange="switchDisabled('#observations')">
                        <label class="form-check-label" for="isLiquidated">
                            Liquidado
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="observations">Observaciones</label>
                    <textarea class="form-control" id="observations" name="observations" placeholder="Ingrese lo que se le solicita"" maxlength="500" <?php if (!$vars['data']['isLiquidated']) { echo 'disabled'; } ?> required><?php echo $vars['data']['observations'] ?></textarea>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="update();">Actualizar</button>

            </form>
            
            <script>
                updateSelect();
            </script>

            <hr>

            <a href="?controller=Employee"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
