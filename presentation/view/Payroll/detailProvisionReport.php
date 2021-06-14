<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Nómina Quincenal de Salarios</title>

    <style type="text/css">
        .header p {
            color: blue;
            margin: 0px;
        }

        table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
            font-family: 'freeserif';
            font-size: 13px;
            padding: 0px;
        }

        th {
            background-color: #dddddd;
        }

        td, th {
            margin: 0px;
            padding: 5px;
        }

        table td, table th {
            overflow-wrap: anywhere;
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
            <td style="width: 10%;">
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
                <h4><strong><u>Provisiones de Ley - Detalle por Empleado</u></strong></h4>
            </td>
            <td style="width: 20%;"></td>
        </tr>
    </table>
</div>

<div>
    <div style="width: 150px; padding-bottom: 10px">
        <table>
            <tr>
                <th class="border" style="width: 30%">Mes</th>
                <td style="text-align: center; width: 70%;" class="border"><?= $data['month'] ?></td>
            </tr>

            <tr>
                <th class="border" style="width: 30%">Año</th>
                <td style="text-align: center; width: 70%;" class="border"><?= $data['year'] ?></td>
            </tr>
        </table>
    </div>

    <div>
        <table>
            <colgroup>
                <col span="1" style="width: 50px;">
                <col span="1" style="width: 135px;">
                <col span="2" style="width: 70px;">
                <col span="6" style="width: 61px;">
                <col span="1" style="width: 70px;">
            </colgroup>
            <tr>
                <th class="border" style="text-align: center;">Cédula</th>
                <th class="border" style="text-align: center;">Nombre Completo</th>
                <th class="border" style="text-align: center;">Localidad</th>
                <th class="border" style="text-align: center;">Salario Devengado</th>
                <th class="border" style="text-align: center;">CCSS <?= $data['params']['ccss'] * 100 ?>%</th>
                <th class="border" style="text-align: center;">Aguinaldo <?= $data['params']['bonus'] * 100 ?>%</th>
                <th class="border" style="text-align: center;">Vacaciones <?= $data['params']['vacations'] * 100 ?>%</th>
                <th class="border" style="text-align: center;">Pre-Aviso <?= $data['params']['pre'] * 100 ?>%</th>
                <th class="border" style="text-align: center;">Cesantía <?= $data['params']['unemployment'] * 100 ?>%</th>
                <th class="border" style="text-align: center;">Ley PT <?= $data['params']['pt'] * 100 ?>%</th>
                <th class="border" style="text-align: center;">Total <?= $data['params']['total'] * 100 ?>%</th>
            </tr>

            <?php
            $totalAccrued = 0;
            $totalCCSS = 0;
            $totalBonus = 0;
            $totalVacation = 0;
            $totalPre = 0;
            $totalUnemployment = 0;
            $totalPt = 0;
            $total = 0;
            foreach ($data['data'] as $value) {
            ?>
                <tr>
                    <td class="border"><?= $value['card'] ?></td>
                    <td class="border" style="text-align: center;"><?= $value['completeName'] ?></td>
                    <td class="border" style="text-align: center;"><?= $value['location'] ?></td>
                    <td class="border" style="text-align: center;">
                        <?= '₡' . number_format($value['salary'], 2, '.', ' '); ?>
                    </td>
                    <td class="border" style="text-align: center;">
                        <?= '₡' . number_format($value['ccss'], 2, '.', ' '); ?>
                    </td>
                    <td class="border" style="text-align: center;">
                        <?= '₡' . number_format($value['bonus'], 2, '.', ' '); ?>
                    </td>
                    <td class="border" style="text-align: center;">
                        <?= '₡' . number_format($value['vacations'], 2, '.', ' '); ?>
                    </td>
                    <td class="border" style="text-align: center;">
                        <?= '₡' . number_format($value['pre'], 2, '.', ' '); ?>
                    </td>
                    <td class="border" style="text-align: center;">
                        <?= '₡' . number_format($value['unemployment'], 2, '.', ' '); ?>
                    </td>
                    <td class="border" style="text-align: center;">
                        <?= '₡' . number_format($value['pt'], 2, '.', ' '); ?>
                    </td>
                    <td class="border" style="text-align: center;">
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
                <th class="border" style="text-align: center;">Totales</th>
                <th class="border" style="text-align: center;">---</th>
                <th class="border" style="text-align: center;">---</th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($totalAccrued, 2, '.', ' '); ?></th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($totalCCSS, 2, '.', ' '); ?></th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($totalBonus, 2, '.', ' '); ?></th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($totalVacation, 2, '.', ' '); ?></th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($totalPre, 2, '.', ' '); ?></th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($totalUnemployment, 2, '.', ' '); ?></th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($totalPt, 2, '.', ' '); ?></th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($total, 2, '.', ' '); ?></th>
            </tr>
        </table>
    </div>
</div>

</body>
</html>

