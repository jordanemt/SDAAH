<?php
$vars["viewName"] = 'parameters';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Parámentros</h2>
        </div>

        <div class="card-body">

            <hr>

            <table id="data-table" class="table table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Tasa</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['name']; ?></td>
                            <td class="text-center"><?= $value['percentage'] . '%' ?></td>
                            <td class="text-center">
                                <a href="#" onclick="updateParam(<?= $value['id'] ?>, <?= $value['percentage'] ?>);"><i class="fa fa-edit"></i> Editar</a>
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
