<?php
$vars["viewName"] = 'position';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Actualizar Puesto</h2>
        </div>

        <div class="card-body">

            <a href="?controller=position"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <div class="form-row">
                    <div class="form-group d-none">
                        <input type="number" class="form-control" id="id" name="id" value="<?= $vars['data']['id']; ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cod">Código</label>
                        <input type="text" class="form-control fourDigitsMask" id="cod" name="cod" minlength="4" maxlength="4" value="<?= $vars['data']['cod']; ?>" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control textMask" id="name" name="name" maxlength="25" value="<?= $vars['data']['name']; ?>" required>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="type">Tipo</label>
                        <select class="form-control" id="type" name="type" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option <?php if ($vars['data']['type'] == 'Mensual') { echo 'selected'; } ?> value="Mensual">Mensual</option>
                            <option <?php if ($vars['data']['type'] == 'Diario') { echo 'selected'; } ?> value="Diario">Diario</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="salary">Salario</label>
                        <input type="text" class="form-control moneyMask" id="salary" name="salary" value="<?= $vars['data']['salary']; ?>" required>
                    </div>
                </div>


                <button id="submit-button" type="button" class="btn btn-primary" onclick="updatePosition();">Actualizar</button>
            </form>

            <hr>

            <a href="?controller=position"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
