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

                <div class="col-md-12 px-0">

                    <form id="search" class="col-md-12 px-0" action="" method="get">
                        
                        <input class="d-none" type="text" name="controller" value="bonus" readonly>
                        
                        <input class="d-none" type="text" name="action" value="detail" readonly>

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

            <table id="data-table" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
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
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['card'] ?></td>
                            <td class="text-center"><?= $value['completeName'] ?></td>
                            <td class="text-center"><?= $value['bankAccount'] ?></td>
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
                                if (empty($value['alimonyId'])) {
                                    ?>
                                    <a href="#" onclick="insertAlimony(<?= $value['id'] ?>)"><i class="fa fa-edit"></i> Editar</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="#" onclick="updateAlimony(<?= $value['alimonyId'] ?>)"><i class="fa fa-edit"></i> Editar</a>
                                    <?php
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?= '₡' . number_format($value['net'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <a href="?controller=bonus&action=vaucher&id=
                                    <?= $value['id'] . '&year=' . $value['year'] . 
                                        '&accruing=' . $value['accruing'] . 
                                        '&grossBonus=' . $value['grossBonus'] . 
                                        '&alimony=' . $value['alimony'] . 
                                        '&net=' . $value['net'] 
                                    ?>" onclick="successMessageVaucher();"><i class="fa fa-download"></i> Descargar</a>
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
