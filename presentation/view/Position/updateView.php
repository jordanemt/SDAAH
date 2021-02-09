<?php
$vars["viewName"] = 'position';
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/position.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Actualizar Puesto</h2>
        </div>

        <div class="card-body">

            <a href="?controller=Position"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <div class="form-row">
                    <div class="form-group d-none">
                        <input type="number" class="form-control" id="id" name="id" value="<?php echo $vars['data']['id']; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cod">Código</label>
                        <input type="text" class="form-control numberMask" id="cod" name="cod" placeholder="Ingrese lo que se le solicita" minlength="4" maxlength="4" value="<?php echo $vars['data']['cod']; ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control textMask" id="name" name="name" placeholder="Ingrese lo que se le solicita" maxlength="25" value="<?php echo $vars['data']['name']; ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="type">Tipo</label>
                        <select class="form-control" id="type" name="type" onchange="showSalaryOptions();" required">
                            <option disabled>Seleccione una opción</option>
                            <option <?php if ($vars['data']['type'] == 'Mensual') { echo 'selected'; } ?> value="Mensual">Mensual</option>
                            <option <?php if ($vars['data']['type'] == 'Diario') { echo 'selected'; } ?> value="Diario">Diario</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="salary">Salario</label>
                    <input type="number" class="form-control" id="salary" name="salary" placeholder="Ingrese lo que se le solicita" 
                        <?php if ($vars['data']['type'] == 'Diario') { echo 'disabled'; } ?> value="<?php echo $vars['data']['salary']; ?>" step="any" min="0" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="ordinaryTime">Hora Ordinaria</label>
                        <input type="number" class="form-control" id="ordinaryTime" name="ordinaryTime" placeholder="Ingrese lo que se le solicita" 
                            <?php if ($vars['data']['type'] == 'Mensual') { echo 'disabled'; } ?> value="<?php echo $vars['data']['ordinaryTime']; ?>" step="any" min="0" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="extraTime">Hora Extra</label>
                        <input type="number" class="form-control" id="extraTime" name="extraTime" placeholder="Ingrese lo que se le solicita" 
                            <?php if ($vars['data']['type'] == 'Mensual') { echo 'disabled'; } ?> value="<?php echo $vars['data']['extraTime']; ?>" step="any" min="0" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="doubleTime">Hora Doble</label>
                        <input type="number" class="form-control" id="doubleTime" name="doubleTime" placeholder="Ingrese lo que se le solicita" 
                            <?php if ($vars['data']['type'] == 'Mensual') { echo 'disabled'; } ?> value="<?php echo $vars['data']['doubleTime']; ?>" step="any" min="0" required>
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
