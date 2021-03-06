<?php
$vars["viewName"] = 'payroll';
include_once 'presentation/public/header.php';
?>

<script src="/presentation/public/js/payroll.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Nómina Mensual</h2>
        </div>

        <div class="card-body">

            <div class="d-flex flex-md-row flex-column">

                <div class="col-md-4 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <?php
                    if ($session->validRole(Session::$_DIGITIZER)) {
                        ?>
                        <a class="btn btn-primary mx-1 mb-1-md" href="?controller=payroll&action=getMonthlyReport" role="button"><i class="fa fa-download"></i> Descargar</a>
                        <?php
                    }
                    ?>
                </div>

                <div class="col-md-8 px-0">

                    <form id="search" class="col-md-12 px-0" action="" method="get">

                        <input class="d-none" type="text" name="controller" value="payroll" readonly>

                        <input class="d-none" type="text" name="action" value="monthlyView" readonly>

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

            <table id="data-table" class="table table-hover table-bordered dt-responsive" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">Jornada</th>
                        <th class="text-center">Días</th>
                        <th class="text-center">Horas</th>
                        <th class="text-center">Salario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalDays = 0;
                    $totalHours = 0;
                    $totalSalaries = 0;
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['card'] ?></td>
                            <td class="text-center"><p><?= $value['completeName'] ?></p></td>
                            <td class="text-center"><?= $value['type'] == 'Mensual' ? 'Jornada Completa' : 'Tiempo Parcial' ?></td>
                            <td class="text-center"><?= $value['days'] ? $value['days'] : '---' ?></td>
                            <td class="text-center"><?= $value['hours'] ? $value['hours'] : '---' ?></td>
                            <td class="text-center"><?= '₡' . number_format($value['net'], 2, '.', ' '); ?></td>
                        </tr>
                        <?php
                        $totalDays += $value['days'];
                        $totalHours += $value['hours'];
                        $totalSalaries += $value['net'];
                    }
                    ?>
                    <tr>
                        <th class="text-center">Totales</th>
                        <th class="text-center">---</th>
                        <th class="text-center">---</th>
                        <th class="text-center"><?= $totalDays ?></th>
                        <th class="text-center"><?= $totalHours ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalSalaries, 2, '.', ' '); ?></th>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
