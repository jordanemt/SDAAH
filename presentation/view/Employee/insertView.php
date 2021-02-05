<?php
$vars["viewName"] = 'employee';
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/employee.js" type="text/javascript"></script>

<div class="container my-4">

    <div class="card">

        <div class="card-header text-center">
            <h2>Insertar Empleado</h2>
        </div>

        <div class="card-body">

            <a href="?controller=Employee"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">

                <h4>Datos Personales</h4>

                <div class="form-group">
                    <label for="card">Cédula</label>
                    <input type="text" class="form-control" id="card" name="card" placeholder="Ingrese lo que se le solicita" maxlength="30" required>
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
                        <label for="gender">Sexo</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="birthdate">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>

                <h4>Datos Laborales</h4>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="type">Tipo</label>
                        <select class="form-control" id="type" name="type" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="Mensual">Mensual</option>
                            <option value="Diario">Diario</option>
                        </select>
                    </div>

                    <div id="position-container" class="form-group col-md-6">
                        <label for="id_position">Puesto</label>
                        <select class="form-control" id="gender" name="gender" required>
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
                        <input type="date" class="form-control" id="admissionDate" name="admissionDate" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>

                <h4>Banco y Contacto</h4>

                <div class="form-group">
                    <label for="bankAccount">Número de Cuenta Bancaria</label>
                    <input type="text" class="form-control" id="bankAccount" name="bankAccount" placeholder="Ingrese lo que se le solicita" maxlength="50" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese lo que se le solicita" maxlength="100" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="css/ins">CSS/INS</label>
                        <input type="number" class="form-control" id="css/ins" name="css/ins" placeholder="Ingrese lo que se le solicita" maxlength="4" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="affiliate" name="affiliate" value="1">
                        <label class="form-check-label" for="defaultCheck1">
                            Afiliado
                        </label>
                    </div>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="insert();">Insertar</button>

            </form>

            <hr>

            <a href="?controller=Employee"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
