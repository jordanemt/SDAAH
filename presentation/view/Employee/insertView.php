<?php
$vars["viewName"] = 'employee';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">

    <div class="card">

        <div class="card-header text-center">
            <h2>Insertar Empleado</h2>
        </div>

        <div class="card-body">

            <a href="?controller=employee"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">

                <h4>Datos Personales</h4>

                <div class="form-group">
                    <label for="card">Cédula</label>
                    <input type="text" class="form-control cardMask" id="card" name="card" minlength="9" maxlength="9" required>
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
                        <label for="gender">Sexo</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="birthdate">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="dd-mm-yyyy" required>
                    </div>
                </div>

                <h4>Datos Laborales</h4>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="type">Tipo</label>
                        <select class="form-control" id="type" name="type" onchange="updateSelectIdPosition();" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="Mensual">Mensual</option>
                            <option value="Diario">Diario</option>
                        </select>
                    </div>

                    <div id="position-container" class="form-group col-md-6">
                        <label for="idPosition">Puesto</label>
                        <select class="form-control" id="idPosition" name="idPosition" title="Seleccione una opción" required>
                            <option selected disabled>Debe seleccionar un Tipo</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="location">Localidad</label>
                        <select class="form-control" id="location" name="location" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Operativo">Operativo</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="admissionDate">Fecha de Ingreso</label>
                        <input type="date" class="form-control" id="admissionDate" name="admissionDate" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>

                <h4>Banco y Contacto</h4>

                <div class="form-group">
                    <label for="bankAccount">Número de Cuenta Bancaria</label>
                    <input type="text" class="form-control accountMask" id="bankAccount" name="bankAccount" minlength="15" maxlength="15" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="100" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cssIns">CSS/INS</label>
                        <input type="text" class="form-control fourDigitsMask" id="cssIns" name="cssIns" minlength="4" maxlength="4" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="isAffiliated" name="isAffiliated" value="1">
                        <label class="form-check-label" for="isAffiliated">
                            Afiliado
                        </label>
                    </div>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="insertEmployee();">Insertar</button>

            </form>

            <hr>

            <a href="?controller=employee"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
