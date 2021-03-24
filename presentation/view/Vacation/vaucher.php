<?php
$currencyPath = 'presentation/public/img/colon.png';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Comprobante</title>

        <style type="text/css">
            .header p{
                color: blue;
                margin: 0px;
            }

            table{
                margin: auto; 
                width:95%; 
                border-collapse: collapse;
                padding: 0px;
            }

            th{
                background-color: #dddddd;
            }

            td, th{
                margin: 0px;
                padding: 1px;
            }

            .border {
                border: 1px solid #8c8c8c;
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
                        <h4><strong><u>Cálculo de Vacaciones Anuales por Empleado</u></strong></h4>
                    </td>
                    <td style="width: 20%;"></td>
                </tr>
            </table>
        </div>

        <div class="body">
            <table>
                <tr>
                    <td style="width: 100%; text-align: center;" class="border"><strong>Datos Personales</strong></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 14%; text-align: center;" class="border">Cédula #:</th>
                    <td style="width: 14%; text-align: center;" class="border"><?= $data['card'] ?></td>
                    <th style="width: 14%; text-align: center;" class="border">Nombre:</th>
                    <td style="width: 58%; text-align: center;" class="border"><?= $data['completeName'] ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 14%; text-align: center;" class="border">Puesto:</th>
                    <td style="width: 30%; text-align: center;" class="border"><?= $data['position'] ?></td>
                    <th style="width: 14%; text-align: center;" class="border">F. Ingreso:</th>
                    <td style="width: 14%; text-align: center;" class="border"><?= date('d-m-Y', strtotime($data['admissionDate'])); ?></td>
                    <th style="width: 14%; text-align: center;" class="border">F. Vacac:</th>
                    <td style="width: 14%; text-align: center;" class="border"><?= date('d-m-Y', strtotime($data['vacationDate'])); ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width: 44%; border-right: 1px solid #8c8c8c;"></td>
                    <th style="width: 14%; text-align: center;" class="border">Días:</th>
                    <td style="width: 14%; text-align: center;" class="border"><?= $data['vacationDays'] ?></td>
                    <th style="width: 14%; text-align: center;" class="border">Quincena:</th>
                    <td style="width: 14%; text-align: center;" class="border"><?= 'Q-' . $data['vacationFortnight'] ?></td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <th style="width: 100%; text-align: center;" class="border">Salario Base para el Cálculo</th>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 20%; text-align: center;" class="border">Quincena</th>
                    <th style="width: 20%; text-align: center;" class="border">Año</th>
                    <th style="width: 40%; text-align: center;" class="border">Devengando</th>
                    <th style="width: 20%; text-align: center;" class="border">Días</th>
                </tr>

                <?php
                foreach ($data['fortnight'] as $key => $value) {
                    ?>
                    <tr>
                        <td style="width: 20%; text-align: center;" class="border"><?= $value ?></td>
                        <td style="width: 20%; text-align: center;" class="border"><?= $data['year'][$key] ?></td>
                        <td style="width: 40%; text-align: center;" class="border">
                            <img src="<?= $currencyPath ?>" height="12">
                            <?= number_format($data['accruing'][$key], 2, '.', ' '); ?>
                        </td>
                        <td style="width: 20%; text-align: center;" class="border"><?= $data['days'][$key] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <table>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Total Salarios</th>
                    <td style="width: 40%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['salaryTotal'], 2, '.', ' '); ?>
                    </td>
                    <td style="width: 20%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= $data['daysTotal']; ?>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Sal. Prom. Diario</th>
                    <td style="width: 40%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['avgSalary'], 2, '.', ' '); ?>
                    </td>
                    <td style="width: 20%;"></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Devengando</th>
                    <td style="width: 40%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['accruedVacation'], 2, '.', ' '); ?>
                    </td>
                    <td style="width: 20%;"></td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <th style="width: 100%; text-align: center;" class="border">Detalle de Deducciones</th>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width: 60%; text-align: center;" class="border">Cuota Obrera CCSS</td>
                    <td style="width: 40%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['workerCCSS'], 2, '.', ' '); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 60%; text-align: center;" class="border">Impuesto Sobre la Renta</td>
                    <td style="width: 40%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['incomeTax'], 2, '.', ' '); ?>
                    </td>
                </tr>

                <?php
                foreach ($data['deductionsArray'] as $key => $deduction) {
                    ?>
                    <tr>
                        <td style="width: 60%; text-align: center;" class="border"><?= $deduction['name'] ?></td>
                        <td style="width: 40%; text-align: center;" class="border">
                            <img src="<?= $currencyPath ?>" height="12">
                            <?= number_format($data['deductionsMounts'][$key], 2, '.', ' '); ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </table>

            <table>
                <tr>
                    <th style="width: 60%; text-align: center;" class="border">Total Deducciones</th>
                    <td style="width: 40%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['deductionsTotal'], 2, '.', ' '); ?>
                    </td>
                </tr>
                <br>
                <tr>
                    <th style="width: 60%; text-align: center;" class="border">Total Vacaciones Neto a Pagar</th>
                    <td style="width: 40%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['net'], 2, '.', ' '); ?>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width: 100%; text-align: center;" class="border">
                        <?= Util::convertToLetter($data['net']); ?>
                    </td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <td style="width: 5%"></td>
                    <td style="width: 10%; text-align: left;">Hecho:</td>
                    <td style="width: 34%; border-bottom: 1px solid;"></td>
                    <td style="width: 2%"></td>
                    <td style="width: 10%; text-align: left;">Revisado:</td>
                    <td style="width: 34%; border-bottom: 1px solid;"></td>
                    <td style="width: 5%"></td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <td style="width: 5%"></td>
                    <td style="width: 10%; text-align: left;">Aprobado:</td>
                    <td style="width: 80%; border-bottom: 1px solid;"></td>
                    <td style="width: 5%"></td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <td style="width: 5%"></td>
                    <td style="width: 20%; text-align: left;">Recibido Conforme:</td>
                    <td style="width: 70%; border-bottom: 1px solid;"></td>
                    <td style="width: 5%"></td>
                </tr>
                <tr>
                    <td style="width: 5%"></td>
                    <td style="width: 20%;"></td>
                    <td style="width: 70%; text-align: center;"><?= $data['completeName'] ?></td>
                    <td style="width: 5%"></td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <td style="width: 30%; text-align: left;">Original: Oficina, Copia: Empleado</td>
                    <td style="width: 70%;"></td>
                </tr>
            </table>
        </div>
    </body>
</html>
