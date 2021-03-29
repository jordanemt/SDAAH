<?php
$vars["viewName"] = 'parameters';
include_once 'presentation/public/header.php';
$pass = Util::randomPassword();
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Insertar Tramo Imp. Renta</h2>
        </div>

        <div class="card-body">

            <a href="?controller=incomeTax"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="section">Tramo</label>
                        <input type="text" class="form-control moneyMask" id="section" name="section" required>
                        <small id="sectionHelp" class="form-text text-muted">Sobre el exceso de</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="percentage">Tasa</label>
                        <input type="text" class="form-control percentageMask" id="percentage" name="percentage" required>
                    </div>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="insertIncomeTax();">Insertar</button>
            </form>

            <hr>

            <a href="?controller=incomeTax"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
