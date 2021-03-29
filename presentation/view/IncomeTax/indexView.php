<?php
$vars["viewName"] = 'parameters';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Tramos Imp. Renta</h2>
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-md-start justify-content-center">
                <a id="submit-button" class="btn btn-primary" href="?controller=incomeTax&action=insertView" role="button"><i class="fa fa-folder-plus"></i> Insertar</a>
            </div>

            <hr>

            <table id="data-table" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Tramo (Sobre el exceso de)</th>
                        <th class="text-center">Porcentaje</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= '₡' . number_format($value['section'], 2, '.', ' '); ?></td>
                            <td class="text-center"><?= $value['percentage'] . '%' ?></td>
                            <td class="text-center">
                                <a class="font-warning" href="#" onclick="removeIncomeTax(<?= $value['id'] ?>);"><i class="fa fa-trash-alt"></i> Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
