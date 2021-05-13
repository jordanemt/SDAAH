<?php
$vars["viewName"] = 'bonus';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Detalle de Aguinaldos</h2>
        </div>

        <div class="card-body">

            <div class="d-flex flex-md-row flex-column">
                
                <div class="col-md-5 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <a href="" class="toggle-vis">Alternar Meses</a>
                </div>

                <div class="col-md-7 px-0">

                    <form id="search" class="col-md-12 px-0" action="" method="get">

                        <input class="d-none" type="text" name="controller" value="bonus" readonly>

                        <div class="d-flex flex-md-row flex-column justify-content-md-end">

                            <div class="d-flex flex-row p-1">
                                <label for="">Año:&nbsp</label>
                                <select class="form-control form-control-sm selectpicker" data-size="5" id="year" name="year" onchange="submitSearch();">
                                    <?= Util::getSelectYearOptions() ?>
                                </select>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <hr>

            <table id="bonus-table" class="table table-hover table-bordered dt-responsive" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">Cuenta Bancaria</th>
                        <th class="text-center">Diciembre</th>
                        <th class="text-center">Enero</th>
                        <th class="text-center">Febrero</th>
                        <th class="text-center">Marzo</th>
                        <th class="text-center">Abril</th>
                        <th class="text-center">Mayo</th>
                        <th class="text-center">Junio</th>
                        <th class="text-center">Julio</th>
                        <th class="text-center">Agosto</th>
                        <th class="text-center">Septiembre</th>
                        <th class="text-center">Octubre</th>
                        <th class="text-center">Noviembre</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Aguinaldo Bruto</th>
                        <th class="text-center">Pensión Alimenticia</th>
                        <th class="text-center">Aguinaldo Neto</th>
                        <th class="text-center">Boleta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalDecember = 0;
                    $totalJanuary = 0;
                    $totalFebruary = 0;
                    $totalMarch = 0;
                    $totalApril = 0;
                    $totalMay = 0;
                    $totalJune = 0;
                    $totalJuly = 0;
                    $totalAugust = 0;
                    $totalSeptemer = 0;
                    $totalOctuber = 0;
                    $totalNovember = 0;
                    $totalAcrued = 0;
                    $totalGrossBonus = 0;
                    $totalAlimony = 0;
                    $total = 0;
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['card'] ?></td>
                            <td class="text-center"><p><?= $value['completeName'] ?></p></td>
                            <td class="text-center"><?= $value['bankAccount']; ?></td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['december'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['january'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['february'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['march'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['april'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['may'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['june'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['july'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['agoust'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['september'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['octuber'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['november'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['accruing'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['grossBonus'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['alimony'], 2, '.', ' '); ?>
                                <?php
                                if ($session->validRole(Session::$_DIGITIZER)) {
                                    if (empty($value['alimonyId'])) {
                                        ?>
                                        <a href="#" onclick="insertAlimony(<?= $value['idEmployee'] ?>)"><i class="fa fa-edit"></i> Editar</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="#" onclick="updateAlimony(<?= $value['alimonyId'] ?>, <?= $value['alimony'] ?>)"><i class="fa fa-edit"></i> Editar</a>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['net'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <a href="?controller=bonus&action=vaucher&idEmployee=
                                <?=
                                $value['idEmployee'] . '&year=' . $value['year'] .
                                '&accruing=' . $value['accruing'] .
                                '&grossBonus=' . $value['grossBonus'] .
                                '&alimony=' . $value['alimony'] .
                                '&net=' . $value['net']
                                ?>" onclick="successMessageVaucher();"><i class="fa fa-download"></i> Descargar</a>
                            </td>
                        </tr>
                        <?php
                        $totalDecember += $value['december'];
                        $totalJanuary += $value['january'];
                        $totalFebruary += $value['february'];
                        $totalMarch += $value['march'];
                        $totalApril += $value['april'];
                        $totalMay += $value['may'];
                        $totalJune += $value['june'];
                        $totalJuly += $value['july'];
                        $totalAugust += $value['agoust'];
                        $totalSeptemer += $value['september'];
                        $totalOctuber += $value['octuber'];
                        $totalNovember += $value['november'];
                        $totalAcrued += $value['accruing'];
                        $totalGrossBonus += $value['grossBonus'];
                        $totalAlimony += $value['alimony'];
                        $total += $value['net'];
                    }
                    ?>
                    <tr>
                        <th class="text-center">Totales</th>
                        <th class="text-center">---</th>
                        <th class="text-center">---</th>
                        <th class="text-center"><?= '₡' . number_format($totalDecember, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalJanuary, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalFebruary, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalMarch, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalApril, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalMay, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalJune, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalJuly, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalAugust, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalSeptemer, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalOctuber, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalNovember, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalAcrued, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalGrossBonus, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($totalAlimony, 2, '.', ' '); ?></th>
                        <th class="text-center"><?= '₡' . number_format($total, 2, '.', ' '); ?></th>
                        <th class="text-center">-</th>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
