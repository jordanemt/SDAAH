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
                    <td style="width: 85%; padding-top: 35px; font-size: 12px;">
                        <p>Télefono: (506) 2765-4162</p>
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
                        <h4><strong><u>Liquidación Final por Terminación de Contrato</u></strong></h4>
                    </td>
                    <td style="width: 20%;"></td>
                </tr>
            </table>
        </div>

        <div class="body">
            <table>
                <tr>
                    <th style="width: 100%; text-align: center;" class="border">Datos Personales</th>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 14%; text-align: center;" class="border">Cédula:</th>
                    <td style="width: 14%; text-align: center;" class="border"><?= $data['card'] ?></td>
                    <th style="width: 14%; text-align: center;" class="border">Nombre:</th>
                    <td style="width: 30%; text-align: center;" class="border"><?= $data['completeName'] ?></td>
                    <th style="width: 14%; text-align: center;" class="border">Puesto:</th>
                    <td style="width: 14%; text-align: center;" class="border"><?= $data['position'] ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 14%; text-align: center;" class="border">F. Ingreso:</th>
                    <td style="width: 36%; text-align: center;" class="border"><?= date('d-m-Y', strtotime($data['admissionDate'])); ?></td>
                    <th style="width: 14%; text-align: center;" class="border">F. Salida:</th>
                    <td style="width: 36%; text-align: center;" class="border"><?= date('d-m-Y', strtotime($data['departureDate']));?></td>
                </tr>
                <tr>
                    <th style="width: 14%; text-align: center;" class="border">Récord:</th>
                    <td style="width: 36%; text-align: center;" class="border"><?= $data['record'] ?></td>
                    <th style="width: 14%; text-align: center;" class="border">Motivo:</th>
                    <td style="width: 36%; text-align: center;" class="border"><?= $data['reason'] ?></td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <th style="width: 100%; text-align: center;" class="border">Cálculo de Vacaciones</th>
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
                    foreach ($data['vacations']['fortnight'] as $key => $value) {
                    ?>
                    <tr>
                        <td style="width: 20%; text-align: center;" class="border"><?= $value ?></td>
                        <td style="width: 20%; text-align: center;" class="border"><?= $data['vacations']['year'][$key] ?></td>
                        <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['vacations']['accruing'][$key], 2, '.', ' '); ?></td>
                        <td style="width: 20%; text-align: center;" class="border"><?= $data['vacations']['days'][$key] ?></td>
                    </tr>
                    <?php
                }               
                ?>
            </table>

            <table>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Total Salarios</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['vacations']['salaryTotal'], 2, '.', ' '); ?></td>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['vacations']['daysTotal'] ?></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Sal. Prom. Diario</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['vacations']['avgSalary'], 2, '.', ' '); ?></td>
                    <td style="width: 20%;"></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Días de Vacac. Pendientes</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= $data['vacations']['vacationDays'] ?></td>
                    <td style="width: 20%;"></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Devengando Vacaciones</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['vacations']['accruedVacation'], 2, '.', ' '); ?></td>
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
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['workerCCSS'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 60%; text-align: center;" class="border">Impuesto Sobre la Renta</td>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['incomeTax'], 2, '.', ' '); ?></td>
                </tr>

                <?php
                foreach ($data['deductionsArray'] as $key => $deduction) {
                    ?>
                    <tr>
                        <td style="width: 60%; text-align: center;" class="border"><?= $deduction['name'] ?></td>
                        <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['deductionsMounts'][$key], 2, '.', ' '); ?></td>
                    </tr>
                    <?php
                }
                ?>

            </table>

            <table>
                <tr>
                    <th style="width: 60%; text-align: center;" class="border">Total Deducciones</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['deductionsTotal'], 2, '.', ' '); ?></td>
                </tr>
                <br>
                <tr>
                    <th style="width: 60%; text-align: center;" class="border">Neto a Pagar Vacac. Proporcionales</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['netVacation'], 2, '.', ' '); ?></td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <th style="width: 100%; text-align: center;" class="border">Cálculo de Pre-aviso y Cesantía</th>
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
                    foreach ($data['preCen']['fortnight'] as $key => $value) {
                    ?>
                    <tr>
                        <td style="width: 20%; text-align: center;" class="border"><?= $value ?></td>
                        <td style="width: 20%; text-align: center;" class="border"><?= $data['preCen']['year'][$key] ?></td>
                        <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['preCen']['accruing'][$key], 2, '.', ' '); ?></td>
                        <td style="width: 20%; text-align: center;" class="border"><?= $data['preCen']['days'][$key] ?></td>
                    </tr>
                    <?php
                }               
                ?>
            </table>
            
            <table>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Total Salarios</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['preCen']['salaryTotal'], 2, '.', ' '); ?></td>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['preCen']['daysTotal']; ?></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Sal. Prom. Diario</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['preCen']['avgSalary'], 2, '.', ' '); ?></td>
                    <td style="width: 20%; border-bottom: 1px solid #8c8c8c;"></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Días de Pre-aviso</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['preCen']['totalPre'], 2, '.', ' '); ?></td>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['preCen']['preDays']; ?></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Días de Cesantía</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['preCen']['totalCen'], 2, '.', ' '); ?></td>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['preCen']['cenDays']; ?></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Devengando Pre-aviso y Cesantía</th>
                    <td style="width: 40%; text-align: center;" class="border"><?= number_format($data['preCen']['totalPreCen'], 2, '.', ' '); ?></td>
                    <td style="width: 20%;"></td>
                </tr>
            </table>
            
            <br>
            <table>
                <tr>
                    <th style="width: 100%; text-align: center;" class="border">Cálculo del Aguinaldo</th>
                </tr>
            </table>
            
            <table>
                <tr>
                    <th style="width: 20%; text-align: center;" class="border">Quincena</th>
                    <th style="width: 20%; text-align: center;" class="border">Año</th>
                    <th style="width: 60%; text-align: center;" class="border">Devengando</th>
                </tr>
                
                <?php
                foreach ($data['bonusPayments'] as $key => $payment) {
                    if (!empty($payment)) {
                        ?>
                        <tr>
                            <td style="width: 20%; text-align: center;" class="border">Q-<?= $key < 2 ? $key + 23 : $key - 1; ?></td>
                            <td style="width: 20%; text-align: center;" class="border"><?= $payment['year'] ?></td>
                            <td style="width: 60%; text-align: center;" class="border"><?= number_format($payment['net'], 2, '.', ' '); ?></td>
                        </tr>
                        <?php
                    } else {
                        ?>
                        <tr>
                            <td style="width: 20%; text-align: center;" class="border">Q-<?= $key < 2 ? $key + 23 : $key - 1; ?></td>
                            <td style="width: 20%; text-align: center;" class="border"><?= $key < 2 ? $data['bonusYear'] - 1 : $data['bonusYear'] ?></td>
                            <td style="width: 60%; text-align: center;" class="border">-</td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            
            <table>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Total Salarios:</th>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['totalSalariesBonus'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">/ 12 = Devengando Aguinaldo: </th>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['totalBonus'], 2, '.', ' '); ?></td>
                </tr>
            </table>
            
            <br>
            <table>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">A Pagar Prestaciones Legales:</th>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['toPay'], 2, '.', ' '); ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width: 100%; text-align: center;" class="border">
                        <?= Util::convertToLetter($data['toPay']); ?>
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
                    <td style="width: 70%; text-align: center;"><?= '' ?></td>
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
