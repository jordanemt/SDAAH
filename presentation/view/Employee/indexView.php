<?php
$vars["viewName"] = 'employee';
include_once 'presentation/public/header.php';
require_once 'common/Util.php';
?>

<script src="/presentation/public/js/employee.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Lista de Empleados</h2>
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-md-start justify-content-center">
                <a class="btn btn-primary" href="/employee/insertView" role="button"><i class="fa fa-folder-plus"></i> Insertar</a>
            </div>

            <hr>

            <table id="data-table" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">P/Apellido</th>
                        <th class="text-center">S/Apellido</th>
                        <th class="text-center">Sexo</th>
                        <th class="text-center">Puesto</th>
                        <th class="text-center">Localidad</th>
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
                        <th class="text-center">Acción</th>
                        <th class="text-center">Comprobante</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['card'] ?></td>
                            <td class="text-center"><?= $value['name'] ?></td>
                            <td class="text-center"><?= $value['firstLastName'] ?></td>
                            <td class="text-center"><?= $value['secondLastName'] ?></td>
                            <td class="text-center"><?= $value['gender'] ?></td>
                            <td class="text-center"><?= $value['position']['name'] ?></td>
                            <td class="text-center"><?= $value['location'] ?></td>
                            <td class="text-center"><?= $value['bankAccount'] ?></td>
                            <td class="text-center"><?=  date_format(date_create($value['birthdate']), 'd/m/Y'); ?></td>
                            <td class="text-center"><?=  date_format(date_create($value['admissionDate']), 'd/m/Y'); ?></td>
                            <td class="text-center"><?= $value['position']['type'] ?></td>
                            <td class="text-center"><?= ($value['position']['type'] == 'Mensual') ? 
                                    '₡' . number_format($value['position']['salary'], 2, ',', ' ') : '---'; ?>
                            </td>
                            <td class="text-center"><?= ($value['position']['type'] == 'Diario') ? 
                                    '₡' . number_format($value['position']['salary'], 2, ',', ' ') : '---'; ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format(Util::getExtraTime($value['position']['salary'], 
                                        $value['position']['type']), 2, ',', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format(Util::getDoubleTime($value['position']['salary'], 
                                        $value['position']['type']), 2, ',', ' '); ?>
                            </td>
                            <td class="text-center"><?= $value['email'] ?></td>
                            <td class="text-center"><?= $value['isAffiliated'] ? 'Sí' : 'No'; ?></td>
                            <td class="text-center"><?= $value['cssIns'] ?></td>
                            <td class="text-center"><?= $value['isLiquidated'] ? 'Sí' : 'No'; ?></td>
                            <td class="text-center"><?= $value['observations'] ? $value['observations'] : '---'; ?></td>
                            <td class="text-center">
                                <a href="/employee/updateView?&id=<?= $value['id'] ?>"><i class="fa fa-edit"></i> Editar</a>
                                <a class="font-warning" href="#" onclick="confirmDelete(<?= $value['id'] ?>);"><i class="fa fa-trash-alt"></i> Eliminar</a>
                            </td>
                            <td class="text-center">
                                <a href="#"><i class="fa fa-eye"></i> Ver</a>
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
