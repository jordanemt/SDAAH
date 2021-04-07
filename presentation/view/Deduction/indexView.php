<?php
$vars["viewName"] = 'parameters';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Catálogo de Deducciones</h2>
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-md-start justify-content-center">
                <button id="submit-button" class="btn btn-primary" href="#" role="button" onclick="insertDeduction();"><i class="fa fa-folder-plus"></i> Insertar</button>
            </div>

            <hr>

            <table id="data-table" class="table table-hover table-bordered dt-responsive" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['name'] ?></td>
                            <td class="text-center">
                                <a class="font-warning" href="#" onclick="removeDeduction(<?= $value['id'] ?>);"><i class="fa fa-trash-alt"></i> Eliminar</a>
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
