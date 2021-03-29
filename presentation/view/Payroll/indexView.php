<?php
$vars["viewName"] = 'payroll';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Nómina Quincenal</h2>
        </div>

        <div class="card-body">

            <div class="d-flex flex-md-row flex-column">

                <div class="col-md-5 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <?php
                    if ($session->validRole(Session::$_DIGITIZER)) {
                        ?>
                        <a class="btn btn-primary mx-1 mb-1-md" href="?controller=payment&action=insertView" role="button"><i class="fa fa-folder-plus"></i> Pagar</a>
                        <?php
                    }
                    ?>
                </div>

                <div class="col-md-7 px-0">

                    <form id="search" class="col-md-12 px-0" action="" method="get">

                        <input class="d-none" type="text" name="controller" value="payroll" readonly>

                        <div class="d-flex flex-md-row flex-column justify-content-md-end">

                            <div class="d-flex flex-row p-1">
                                <label for="fortnight">Quincena:&nbsp</label>
                                <select class="form-control form-control-sm selectpicker" data-size="5" id="fortnight" name="fortnight" onchange="submitSearch();">
                                    <?= Util::getSelectFortnightOptions() ?>
                                </select>
                            </div>

                            <div class="d-flex flex-row p-1">
                                <label for="year">Año:&nbsp</label>
                                <select class="form-control form-control-sm selectpicker" data-size="5" id="year" name="year" onchange="submitSearch();">
                                    <?= Util::getSelectYearOptions() ?>
                                </select>
                            </div>

                            <div class="d-flex flex-row p-1">
                                <label for="location">Localidad:&nbsp</label>
                                <select class="form-control form-control-sm selectpicker" id="location" name="location" onchange="submitSearch();">
                                    <?= Util::getSelectLocationOptions() ?>
                                </select>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <hr>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">Ordinario</th>
                        <th class="text-center">Vacación</th>
                        <th class="text-center">Extra</th>
                        <th class="text-center">Doble</th>
                        <th class="text-center">Recargo</th>
                        <th class="text-center">Tot. Devengado</th>
                        <th class="text-center">Seguro Social</th>
                        <th class="text-center">Imp. Renta</th>
                        <th class="text-center">Tot. Deducciones</th>
                        <th class="text-center">Incapacidades</th>
                        <th class="text-center">Neto</th>
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
                    $totalOrdinary = 0;
                    $totalVacation = 0;
                    $totalExtra = 0;
                    $totalDouble = 0;
                    $totalSurcharges = 0;
                    $totalAccrued = 0;
                    $totalCCSS = 0;
                    $totalIncome = 0;
                    $totalDeduction = 0;
                    $totalDisabilities = 0;
                    $totalNet = 0;
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['card'] ?></td>
                            <td class="text-center"><p><?= $value['completeName'] ?></p></td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['ordinary'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['vacationAmount'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['extra'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['double'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['surcharges'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <a href="#" class="details-a" onclick="showAccruedDetails(<?= $value['id'] ?>)">
                                    <?= '₡' . number_format($value['gross'], 2, '.', ' '); ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['workerCCSS'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['incomeTax'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <a href="#" class="details-a" onclick="showDeductionsDetails(<?= $value['id'] ?>)">
                                    <?= '₡' . number_format($value['deductionsTotal'], 2, '.', ' '); ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="#" class="details-a" onclick="showDisabilitiesDetails(<?= $value['id'] ?>)">
                                    <?= '₡' . number_format($value['ccssAmount'] + $value['insAmount'], 2, '.', ' '); ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['net'], 2, '.', ' '); ?>
                            </td>
                            <?php
                            if ($session->validRole(Session::$_DIGITIZER)) {
                                ?>
                                <td class="text-center">
                                    <a href="?controller=payment&action=updateView&id=<?= $value['id']; ?>"><i class="fa fa-edit"></i> Editar</a>
                                    <?php
                                    if ($session->validRole(Session::$_ADMIN)) {
                                        ?>
                                        <a class="font-warning" href="#" onclick="removePayment(<?= $value['id']; ?>);"><i class="fa fa-trash-alt"></i> Eliminar</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <?php
                            }
                            ?>
                            <td class="text-center">
                                <a href="?controller=payment&action=vaucher&id=<?= $value['id'] ?>" onclick="successMessageVaucher();"><i class="fa fa-download"></i> Descargar</a>
                            </td>
                            <?php
                            $totalOrdinary += $value['ordinary'];
                            $totalVacation += $value['vacationAmount'];
                            $totalExtra += $value['extra'];
                            $totalDouble += $value['double'];
                            $totalSurcharges += $value['surcharges'];
                            $totalAccrued += $value['gross'];
                            $totalCCSS += $value['workerCCSS'];
                            $totalIncome += $value['incomeTax'];
                            $totalDeduction += $value['deductionsTotal'];
                            $totalDisabilities += $value['ccssAmount'] + $value['insAmount'];
                            $totalNet += $value['net'];
                        }
                        ?>
                    </tr>
                    <tr>
                        <th class="text-center">Totales</th>
                        <th class="text-center">---</th>
                        <th class="text-center"><?= '₡' . number_format($totalOrdinary, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalVacation, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalExtra, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalDouble, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalSurcharges, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalAccrued, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalCCSS, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalIncome, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalDeduction, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalDisabilities, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalNet, 2, '.', ' '); ?></th>
                        <?php
                        if ($session->validRole(Session::$_DIGITIZER)) {
                            ?>
                            <th class="text-center">-</th>
                            <?php
                        }
                        ?>
                        <th class="text-center">-</th>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
