<?php
$currencyPath = 'presentation/public/img/colon.png';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Nómina Quincenal de Salarios</title>

        <style type="text/css">
            .header p{
                color: blue;
                margin: 0px;
            }

            table{ 
                width:100%; 
                border-collapse: collapse;
                padding: 0px;
            }

            th{
                background-color: #dddddd;
            }

            td, th{
                margin: 0px;
                padding: 5px;
            }

            .border {
                border: 1px solid #8c8c8c;
            }
            
            .content-loader tr td {
                white-space: nowrap;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <table>
                <tr>
                    <td style="width: 15%;">
                        <img src="presentation/public/img/logo.png" height="100">
                    </td>
                    <td style="width: 85%; padding-top: 25px; font-size: 12px;">
                        <p>Departamento de Administración</p>
                        <p>Módulo de planilla</p>
                        <p>Whatsapp: (506) 8652-0144</p>
                        <p>Email: acueductoherediana@hotmail.com</p>
                    </td>
                </tr>
            </table>
        </div>
        
        
        <div>
            <table>
                <tr>
                    <td style="width: 20%;"></td>
                    <td style="width: 60%; text-align: center;">
                        <h4><strong><u>Nómina Quincenal de Salarios</u></strong></h4>
                    </td>
                    <td style="width: 20%;"></td>
                </tr>
            </table>
        </div>
        
        
        
        <div class="body">
            <div style="width: 250px;">
                <table>
                    <tr>
                        <th style="width: 55%">Quincena</th>
                        <td style="text-align: center; width: 45%;" class="border"><?= $data[0]['fortnight'] ?></td>
                    </tr>    

                    <tr>
                        <th style="width: 55%">Año</th>
                        <td style="text-align: center; width: 45%;" class="border"><?= $data[0]['year'] ?></td>
                    </tr> 

                    <tr>
                        <th style="width: 55%">Localidad</th>
                        <td style="text-align: center; width: 45%;" class="border"><?= $data[0]['location'] ?></td>
                    </tr> 
                </table>
            </div>
            
            <br>
            
            <div>
                <table>
                    <thead>    
                        <tr>
                            <th style="text-align:">Nombre del Empleado</th>
                            <th style="text-align:">Ordinario</th>
                            <th style="text-align:">Vacación</th>
                            <th style="text-align:">Extra</th>
                            <th style="text-align:">Doble</th>
                            <th style="text-align:">Recargo</th>
                            <th style="text-align:">Tot. Devengado</th>
                            <th style="text-align:">Seguro Social</th>
                            <th style="text-align:">Imp. Renta</th>
                            <th style="text-align:">Total Deducciones</th>
                            <th style="text-align:">Neto por Pagar</th>
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
                        foreach ($data as $value) {
                            ?> 
                            <tr>
                                <td style="text-align:" class="border"><?= $value['completeName'] ?></td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['ordinary'], 2, '.', ' '); ?>   
                                </td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['vacationAmount'], 2, '.', ' '); ?>
                                </td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['extra'], 2, '.', ' '); ?>
                                </td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['double'], 2, '.', ' '); ?>
                                </td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['surcharges'], 2, '.', ' '); ?>
                                </td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['gross'], 2, '.', ' '); ?>
                                </td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['workerCCSS'], 2, '.', ' '); ?>
                                </td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['incomeTax'], 2, '.', ' '); ?>
                                </td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['deductionsTotal'], 2, '.', ' '); ?>
                                </td>
                                <td style="text-align:" class="border">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($value['net'], 2, '.', ' '); ?>
                                </td>

                            </tr>
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
                            <tr>
                                <th style="text-align: center;">Total general</th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalOrdinary, 2, '.', ' '); ?>
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalVacation, 2, '.', ' '); ?>
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalExtra, 2, '.', ' '); ?>
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalDouble, 2, '.', ' '); ?>
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalSurcharges, 2, '.', ' '); ?>
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalAccrued, 2, '.', ' '); ?>
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalCCSS, 2, '.', ' '); ?>
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalIncome, 2, '.', ' '); ?>
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalDeduction, 2, '.', ' '); ?>
                                </th>
                                <th style="text-align: center;">
                                    <img src="<?= $currencyPath ?>" height="12">
                                    <?= number_format($totalNet, 2, '.', ' '); ?>
                                </th>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
