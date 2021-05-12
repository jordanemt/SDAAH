<?php
$vars["viewName"] = 'payroll';
include_once 'presentation/public/header.php';
?>

<script src="/presentation/public/js/payroll.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Reporte Consolidado</h2>
        </div>

        <div class="card-body">

            <a href="?controller=payroll&action=detailProvisionReportView">Detalle por Empleado <i class="fa fa-angle-double-right"></i></a>

            <div class="d-flex flex-md-row flex-column">

                <div class="col-md-2 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <a class="btn btn-info mx-1" href="#" role="button"><i class="fa fa-upload"></i> Enviar Reporte</a>
                </div>

                <div class="col-md-4 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <?php
                    if ($session->validRole(Session::$_DIGITIZER)) {
                        ?>
                        <a class="btn btn-primary mx-1 mb-1-md" href="?controller=payroll&action=getProvisionReport" role="button"><i class="fa fa-download"></i> Descargar</a>
                        <?php
                    }
                    ?>
                </div>

                <div class="col-md-6 px-0">

                    <form id="search" class="col-md-12 px-0" action="" method="get">

                        <input class="d-none" type="text" name="controller" value="payroll" readonly>

                        <input class="d-none" type="text" name="action" value="provisionReportView" readonly>

                        <div class="d-flex flex-md-row flex-column justify-content-md-end">

                            <div class="d-flex flex-row p-1">
                                <label for="month">Mes:&nbsp</label>
                                <select class="form-control form-control-sm selectpicker" data-size="5" id="month" name="month" onchange="submitSearch();">
                                    <?= Util::getSelectMonthOptions(); ?>
                                </select>
                            </div>

                            <div class="d-flex flex-row p-1">
                                <label for="year">Año:&nbsp</label>
                                <select class="form-control form-control-sm selectpicker" data-size="5" id="year" name="year" onchange="submitSearch();">
                                    <?= Util::getSelectYearOptions(); ?>
                                </select>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <hr>

            <table id="data-table" class="table table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Localidad</th>
                        <th class="text-center">Salario Devengado</th>
                        <th class="text-center">CCSS <?= $vars['params']['ccss'] * 100 ?>%</th>
                        <th class="text-center">Aguinaldo <?= $vars['params']['bonus'] * 100 ?>%</th>
                        <th class="text-center">Vacaciones <?= $vars['params']['vacations'] * 100 ?>%</th>
                        <th class="text-center">Pre-Aviso <?= $vars['params']['pre'] * 100 ?>%</th>
                        <th class="text-center">Cesantía <?= $vars['params']['unemployment'] * 100 ?>%</th>
                        <th class="text-center">Ley PT <?= $vars['params']['pt'] * 100 ?>%</th>
                        <th class="text-center">Total <?= $vars['params']['total'] * 100 ?>%</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalAccrued = 0;
                    $totalCCSS = 0;
                    $totalBonus = 0;
                    $totalVacation = 0;
                    $totalPre = 0;
                    $totalUnemployment = 0;
                    $totalPt = 0;
                    $total = 0;
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['location'] ?></td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['salary'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['ccss'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['bonus'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['vacations'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['pre'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['unemployment'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['pt'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['total'], 2, '.', ' '); ?>
                            </td>
                        </tr>
                        <?php
                        $totalAccrued += $value['salary'];
                        $totalCCSS += $value['ccss'];
                        $totalBonus += $value['bonus'];
                        $totalVacation += $value['vacations'];
                        $totalPre += $value['pre'];
                        $totalUnemployment += $value['unemployment'];
                        $totalPt += $value['pt'];
                        $total += $value['total'];
                    }
                    ?>
                    <tr>
                        <th class="text-center">Totales</th>
                        <th class="text-center"><?= '₡' . number_format($totalAccrued, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalCCSS, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalBonus, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalVacation, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalPre, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalUnemployment, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalPt, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($total, 2, '.', ' '); ?></th>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
