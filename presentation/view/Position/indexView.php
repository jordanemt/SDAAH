<?php
$vars["viewName"] = 'position';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Lista de Puestos</h2>
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-md-start justify-content-center">
                <?php
                if ($session->validRole(Session::$_DIGITIZER)) {
                    ?>
                    <a class="btn btn-primary" href="?controller=position&action=insertView" role="button"><i class="fa fa-folder-plus"></i> Insertar</a>
                    <?php
                }
                ?>
            </div>

            <hr>

            <table id="data-table" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Código</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Salario</th>
                        <?php
                        if ($session->validRole(Session::$_DIGITIZER)) {
                            ?>
                            <th class="text-center">Acción</th>
                            <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['cod'] ?></td>
                            <td class="text-center"><?= $value['name'] ?></td>
                            <td class="text-center"><?= $value['type']?></td>
                            <td class="text-center"><?= '₡' . number_format($value['salary'], 2, '.', ' ') ?></td>
                            <?php
                            if ($session->validRole(Session::$_DIGITIZER)) {
                                ?>
                                <td class="text-center">
                                    <a href="?controller=position&action=updateView&id=<?= $value['id']?>"><i class="fa fa-edit"></i> Editar</a>
                                    <?php
                                    if ($session->validRole(Session::$_ADMIN)) {
                                        ?>
                                        <a class="font-warning" href="#" onclick="removePosition(<?= $value['id'] ?>);"><i class="fa fa-trash-alt"></i> Eliminar</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <?php
                            }
                            ?>
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
