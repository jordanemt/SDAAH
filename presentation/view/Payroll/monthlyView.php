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

                <div class="col-md-12 px-0">

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

            <table id="data-table" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">Jornada</th>
                        <th class="text-center">Días</th>
                        <th class="text-center">Horas</th>
                        <th class="text-center">Salario</th>
                        <th class="text-center">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['card'] ?></td>
                            <td class="text-center"><?= $value['completeName'] ?></td>
                            <td class="text-center"><?= $value['type'] == 'Mensual' ? 'Jornada Completa' : 'Tiempo Parcial' ?></td>
                            <td class="text-center"><?= $value['workingDays'] ? $value['workingDays'] : '---' ?></td>
                            <td class="text-center"><?= $value['ordinaryTimeHours'] ? $value['ordinaryTimeHours'] : '---' ?></td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['net'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center"><?= $value['observations'] ? $value['observations'] : '---' ?></td>
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
