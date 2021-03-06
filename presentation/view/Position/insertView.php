<?php

$vars["viewName"] = 'position';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Insertar Puesto</h2>
        </div>

        <div class="card-body">

            <a href="?controller=position"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cod">Código</label>
                        <input type="text" class="form-control fourDigitsMask" id="cod" name="cod" minlength="4" maxlength="4" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="25" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="type">Tipo</label>
                        <select class="form-control" id="type" name="type" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="Mensual">Mensual</option>
                            <option value="Diario">Diario</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="salary">Salario</label>
                        <input type="text" class="form-control moneyMask" id="salary" name="salary" required>
                    </div>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="insertPosition();">Insertar</button>
            </form>

            <hr>

            <a href="?controller=position"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
