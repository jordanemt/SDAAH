<?php
$vars["viewName"] = 'employee';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Lista de Empleados</h2>
        </div>

        <div class="card-body">

            <div class="d-flex flex-md-row flex-column">

                <div class="col-md-5 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <?php
                    if ($session->validRole(Session::$_DIGITIZER)) {
                        ?>
                        <a class="btn btn-primary" href="?controller=employee&action=insertView" role="button"><i class="fa fa-folder-plus"></i> Insertar</a>
                        <?php
                    }
                    ?>
                </div>

                <div class="col-md-7 px-0">

                    <form id="search" class="col-md-12 px-0" action="" method="get">

                        <input class="d-none" type="text" name="controller" value="employee" readonly>

                        <div class="d-flex flex-md-row flex-column justify-content-md-end">

                            <div class="p-1 text-center">
                                <input class="form-check-input" type="checkbox" value="1" id="isLiquidated" name="isLiquidated" 
                                       onchange="submitSearch();" <?= $vars['isLiquidated'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="isLiquidated">
                                    Liquidados
                                </label>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <hr>

            <table id="data-table" class="table table-hover table-bordered dt-responsive" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">P/Apellido</th>
                        <th class="text-center">S/Apellido</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Sexo</th>
                        <th class="text-center">Puesto</th>
                        <th class="text-center">Localidad</th>
                        <th class="text-center">Banco</th>
                        <th class="text-center">N/Cuenta</th>
                        <th class="text-center">F/Nacimiento</th>
                        <th class="text-center">F/Ingreso</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Salario</th>
                        <th class="text-center">Hora Ordinaria</th>
                        <th class="text-center">Hora Extra</th>
                        <th class="text-center">Hora Doble</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Afiliado</th>
                        <th class="text-center">CSS/INS</th>
                        <th class="text-center">Liquidado</th>
                        <th class="text-center">Observaciones</th>
                        <?php
                        if ($session->validRole(Session::$_DIGITIZER)) {
                            ?>
                            <th class="text-center">Acción</th>
                            <?php
                        }
                        ?>
                        <th class="text-center">Boleta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr class="<?= $value['isLiquidated'] ? 'isLiquidated' : ''; ?>">
                            <td class="text-center"><?= $value['card'] ?></td>
                            <td class="text-center"><?= $value['firstLastName'] ?></td>
                            <td class="text-center"><?= $value['secondLastName'] ?></td>
                            <td class="text-center"><?= $value['name'] ?></td>
                            <td class="text-center"><?= $value['gender'] ?></td>
                            <td class="text-center"><?= $value['position']['name'] ?></td>
                            <td class="text-center"><?= $value['location'] ?></td>
                            <td class="text-center"><?= $value['bank'] ?></td>
                            <td class="text-center"><?= $value['bankAccount'] ?></td>
                            <td class="text-center"><?= date_format(date_create($value['birthdate']), 'd/m/Y'); ?></td>
                            <td class="text-center"><?= date_format(date_create($value['admissionDate']), 'd/m/Y'); ?></td>
                            <td class="text-center"><?= $value['position']['type'] ?></td>
                            <td class="text-center">
                                <?=
                                ($value['position']['type'] == 'Mensual') ?
                                        '₡' . number_format($value['position']['salary'], 2, ',', ' ') : '---';
                                ?>
                            </td>
                            <td class="text-center">
                                <?=
                                ($value['position']['type'] == 'Diario') ?
                                        '₡' . number_format($value['position']['salary'], 2, ',', ' ') : '---';
                                ?>
                            </td>
                            <td class="text-center">
                                <?=
                                '₡' . number_format(Util::getExtraTime($value['position']['salary'],
                                                $value['position']['type']), 2, ',', ' ');
                                ?>
                            </td>
                            <td class="text-center">
                                <?=
                                '₡' . number_format(Util::getDoubleTime($value['position']['salary'],
                                                $value['position']['type']), 2, ',', ' ');
                                ?>
                            </td>
                            <td class="text-center"><p><?= $value['email'] ? $value['email'] : '---' ?></p></td>
                            <td class="text-center"><?= $value['isAffiliated'] ? 'Sí' : 'No'; ?></td>
                            <td class="text-center"><?= $value['cssIns'] ?></td>
                            <td class="text-center"><?= $value['isLiquidated'] ? 'Sí' : 'No'; ?></td>
                            <td class="text-center">
                                <?php
                                if ($value['observations']) {
                                    ?>
                                    <a href="#" onclick="showMessage('<?= $value['observations'] ?>')"><i class="fa fa-eye"></i> Ver</a>
                                    <?php
                                } else {
                                    echo '---';
                                }
                                ?>
                            </td>
                            <?php
                            if ($session->validRole(Session::$_DIGITIZER)) {
                                ?>
                                <td class="text-center">
                                    <a href="?controller=employee&action=updateView&id=<?= $value['id'] ?>"><i class="fa fa-edit"></i> Editar</a>
                                    <?php
                                    if ($session->validRole(Session::$_ADMIN)) {
                                        ?>
                                        <a class="font-warning" href="#" onclick="removeEmployee(<?= $value['id'] ?>);"><i class="fa fa-trash-alt"></i> Eliminar</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <?php
                            }
                            ?>
                            <td class="text-center">
                                <a href="?controller=employee&action=vaucher&id=<?= $value['id'] ?>" onclick="successMessageVaucher();"><i class="fa fa-download"></i> Descargar</a>
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
