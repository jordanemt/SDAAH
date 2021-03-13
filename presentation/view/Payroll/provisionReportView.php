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

                <div class="col-md-5 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <a class="btn btn-info mx-1" href="#" role="button"><i class="fa fa-file"></i> Generar Boleta</a>
                    <a class="btn btn-info mx-1" href="#" role="button"><i class="fa fa-upload"></i> Enviar Reporte</a>
                </div>

                <div class="col-md-7 px-0">

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

            <table id="data-table" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Localidad</th>
                        <th class="text-center">Salario Devengado</th>
                        <th class="text-center">CCSS 26,33%</th>
                        <th class="text-center">Aguinaldo 8,33%</th>
                        <th class="text-center">Vacaciones 4,16%</th>
                        <th class="text-center">Cesantía 8,33%</th>
                        <th class="text-center">Ley PT 4,75%</th>
                        <th class="text-center">Total 51,9%</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                                <?= '₡' . number_format($value['unemployment'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['pt'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['total'], 2, '.', ' '); ?>
                            </td>
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
