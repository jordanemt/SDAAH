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
                        <p>Departamento de Administración</p>
                        <p>Módulo de planilla</p>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width: 80%; border-right: 1px solid #8c8c8c;"></td>
                    <th style="width: 10%; text-align: center;" class="border">Fecha:</th>
                    <td style="width: 10%; text-align: center;" class="border"><?= date('d-m-Y') ?></td>
                </tr>
            </table>
        </div>

        <div>
            <table>
                <tr>
                    <td style="width: 20%;"></td>
                    <td style="width: 60%; text-align: center;">
                        <h4><strong><u>Comprobante de Pago <?= 'N° Q-' . $data['fortnight'] . '.' . $data['year'] . '.' . $data['employee']['card'] ?></u></strong></h4>
                    </td>
                    <td style="width: 20%;"></td>
                </tr>
            </table>
        </div>

        <div class="body">
            <table>
                <tr>
                    <th style="width: 10%; text-align: center;" class="border">Cédula:</th>
                    <td style="width: 25%; text-align: center;" class="border"><?= $data['employee']['card'] ?></td>
                    <th style="width: 10%; text-align: center;" class="border">Localidad:</th>
                    <td style="width: 25%; text-align: center;" class="border"><?= $data['employee']['location'] ?></td>
                    <th style="width: 10%; text-align: center;" class="border">Quincena:</th>
                    <td style="width: 7%; text-align: center;" class="border"><?= 'Q-' . $data['fortnight'] ?></td>
                    <th style="width: 5%; text-align: center;" class="border">Año:</th>
                    <td style="width: 8%; text-align: center;" class="border"><?= $data['year'] ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 10%; text-align: center;" class="border">Nombre:</th>
                    <td style="width: 60%; text-align: center;" class="border"><?= $data['employee']['firstLastName'] . ' ' . $data['employee']['secondLastName'] . ' ' . $data['employee']['name'] ?></td>
                    <th style="width: 10%; text-align: center;" class="border">Puesto:</th>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['employee']['position']['name'] ?></td>
                </tr>
            </table>

            <br>

            <table>
                <tr>
                    <th style="width: 10%; text-align: center;" class="border">Ingresos:</th>
                    <td style="width: 30%; text-align: center;" class="border"><strong><?= number_format($data['payment']['accrued'] + floatval($data['ccssAmount']) + floatval($data['insAmount']), 2, '.', ' '); ?></strong></td>
                    <td style="width: 60%;"></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Detalle</th>
                    <th style="width: 60%; text-align: center;" class="border">Devengando</th>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">Ordinario</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['payment']['ordinary'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">Extraordinario</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['payment']['extra'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">Doble</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['payment']['double'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">Vacaciones</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['vacationAmount'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">Bono</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['salaryBonus'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">Maternidad</td>
                    <td style="width: 21%; text-align: center;" class="border"><?= number_format($data['maternityAmount'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">CCSS</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['ccssAmount'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">INS</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['insAmount'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">Incentivo</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['incentives'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">Recargos</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['surcharges'], 2, '.', ' '); ?></td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <th style="width: 10%; text-align: center;" class="border">Deducc:</th>
                    <td style="width: 30%; text-align: center;" class="border"><strong><?= number_format($data['payment']['deductions'], 2, '.', ' '); ?></strong></td>
                    <td style="width: 60%;"></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Detalle</th>
                    <th style="width: 60%; text-align: center;" class="border">Devengando</th>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">CCSS/Bco. Popular</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['payment']['workerCss'], 2, '.', ' '); ?></td>
                </tr>
                <tr>
                    <td style="width: 40%; text-align: center;" class="border">Impuesto Sobre Renta</td>
                    <td style="width: 60%; text-align: center;" class="border"><?= number_format($data['payment']['incomeTax'], 2, '.', ' '); ?></td>
                </tr>
                
                <?php
                foreach ($data['deductions'] as $deduction) {
                    ?>
                    <tr>
                        <td style="width: 40%; text-align: center;" class="border"><?= $deduction['name'] ?></td>
                        <td style="width: 60%; text-align: center;" class="border"><?= number_format($deduction['mount'], 2, '.', ' '); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <br>
            <table>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Neto a Pagar:</th>
                    <td style="width: 60%; text-align: center;" class="border"><strong><?= number_format($data['payment']['net'], 2, '.', ' '); ?></strong></td>
                </tr>
            </table>
            
            <table>
                <tr>
                    <td style="width: 100%; text-align: center;" class="border">
                        <?php
                        echo Util::convertToLetter($data['payment']['net']);
                        ?>
                    </td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <th style="width: 10%; text-align: center;" class="border">Días:</th>
                    <td style="width: 10%; text-align: center;" class="border"><strong><?= $data['workingDays'] + $data['vacationsDays'] + $data['ccssDays'] + $data['insDays'] + $data['maternityDays'] ?></strong></td>
                    <td style="width: 50%; border-right: 1px solid #8c8c8c;"></td>
                    <th style="width: 10%; text-align: center;" class="border">Horas:</th>
                    <td style="width: 10%; text-align: center;" class="border"><strong><?= $data['ordinaryTimeHours'] + $data['extraTimeHours'] + $data['doubleTimeHours'] ?></strong></td>
                    <td style="width: 10%;"></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width: 10%; text-align: center;" class="border">Laborados</td>
                    <td style="width: 10%; text-align: center;" class="border">Vacaciones</td>
                    <td style="width: 10%; text-align: center;" class="border">Inc. CCSS</td>
                    <td style="width: 10%; text-align: center;" class="border">Inc. INS</td>
                    <td style="width: 10%; text-align: center;" class="border">Maternidad</td>
                    <td style="width: 15%; border-right: 1px solid #8c8c8c;"></td>
                    <td style="width: 10%; text-align: center;" class="border">Ord.</td>
                    <td style="width: 10%; text-align: center;" class="border">Extra</td>
                    <td style="width: 10%; text-align: center;" class="border">Doble</td>
                </tr>
                <tr>
                    <td style="width: 10%; text-align: center;" class="border"><?= !empty($data['workingDays']) ? $data['workingDays'] : '-'; ?></td>
                    <td style="width: 10%; text-align: center;" class="border"><?= !empty($data['vacationsDays']) ? $data['vacationsDays'] : '-'; ?></td>
                    <td style="width: 10%; text-align: center;" class="border"><?= !empty($data['ccssDays']) ? $data['ccssDays'] : '-'; ?></td>
                    <td style="width: 10%; text-align: center;" class="border"><?= !empty($data['insDays']) ? $data['insDays'] : '-'; ?></td>
                    <td style="width: 10%; text-align: center;" class="border"><?= !empty($data['maternityDays']) ? $data['maternityDays'] : '-'; ?></td>
                    <td style="width: 20%; border-right: 1px solid #8c8c8c;"></td>
                    <td style="width: 10%; text-align: center;" class="border"><?= !empty($data['ordinaryTimeHours']) ? $data['ordinaryTimeHours'] : '-'; ?></td>
                    <td style="width: 10%; text-align: center;" class="border"><?= !empty($data['extraTimeHours']) ? $data['extraTimeHours'] : '-'; ?></td>
                    <td style="width: 10%; text-align: center;" class="border"><?= !empty($data['doubleTimeHours']) ? $data['doubleTimeHours'] : '-'; ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>