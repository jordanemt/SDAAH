<?php

$vars["position-view"] = true;
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/position.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Actualizar Puesto</h2>
        </div>

        <div class="card-body">

            <a href="?controllerPosition"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="id">Código</label>
                        <input type="number" class="form-control" id="id" name="id" placeholder="Ingrese lo que se le solicita" minlength="4" maxlength="4" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese lo que se le solicita" maxlength="40" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="type">Tipo</label>
                        <select class="form-control" id="type" name="type" required">
                            <option selected disabled>Seleccione una opción</option>
                            <option value="Mensual" onclick="switchVisibilityToShow('#salary-container'); switchVisibilityToHide('#time-container');">Mensual</option>
                            <option value="Diario" onclick="switchVisibilityToShow('#time-container'); switchVisibilityToHide('#salary-container');">Diario</option>
                        </select>
                    </div>
                </div>

                <div id="salary-container" class="form-group"> <script>switchVisibilityToHide('#salary-container');</script>
                    <label for="salary">Salario</label>
                    <input type="text" class="form-control" id="salary" name="salary" placeholder="Ingrese lo que se le solicita" required>
                </div>

                <div id="time-container" class="form-row"> <script>switchVisibilityToHide('#time-container');</script>
                    <div class="form-group col-md-4">
                        <label for="ordinaryTime">Hora Ordinaria</label>
                        <input type="text" class="form-control" id="ordinaryTime" name="ordinaryTime" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="extraTime">Hora Extra</label>
                        <input type="text" class="form-control" id="extraTime" name="extraTime" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="doubleTime">Hora Doble</label>
                        <input type="text" class="form-control" id="doubleTime" name="doubleTime" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="update();">Actualizar</button>
            </form>

            <hr>

            <a href="?controller=Position"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
