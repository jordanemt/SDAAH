<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Nómina Mensual de Salarios</title>

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
                <h4><strong><u>Nómina Mensual de Salarios</u></strong></h4>
            </td>
            <td style="width: 20%;"></td>
        </tr>
    </table>
</div>

<div>
    <div style="width: 150px;">
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

    <br>

    <div>
        <table>
            <colgroup>
                <col style="width: 70px;">
                <col style="width: 165px;">
                <col span="3" style="width: 60px;">
                <col style="width: 100px;">
            </colgroup>
            <tr>
                <th class="border" style="text-align: center;">Cédula</th>
                <th class="border" style="text-align: center;">Nombre Completo</th>
                <th class="border" style="text-align: center;">Jornada</th>
                <th class="border" style="text-align: center;">Días</th>
                <th class="border" style="text-align: center;">Horas</th>
                <th class="border" style="text-align: center;">Salario</th>
            </tr>

            <?php
            $totalDays = 0;
            $totalHours = 0;
            $totalSalaries = 0;

            foreach ($data['data'] as $value) {
            ?>
                <tr>
                    <td class="border" style="text-align: center;"><?= $value['card'] ?></td>
                    <td class="border" style="text-align: center;"><p><?= $value['completeName'] ?></p></td>
                    <td class="border" style="text-align: center;"><?= $value['type'] == 'Mensual' ? 'Jornada Completa' : 'Tiempo Parcial' ?></td>
                    <td class="border" style="text-align: center;"><?= $value['days'] ? $value['days'] : '---' ?></td>
                    <td class="border" style="text-align: center;"><?= $value['hours'] ? $value['hours'] : '---' ?></td>
                    <td class="border" style="text-align: center;"><?= '₡' . number_format($value['net'], 2, '.', ' '); ?></td>
                </tr>
                <?php
                $totalDays += $value['days'];
                $totalHours += $value['hours'];
                $totalSalaries += $value['net'];
            }
            ?>
            <tr>
                <th class="border" style="text-align: center;">Totales</th>
                <th class="border" style="text-align: center;">---</th>
                <th class="border" style="text-align: center;">---</th>
                <th class="border" style="text-align: center;"><?= $totalDays ?></th>
                <th class="border" style="text-align: center;"><?= $totalHours ?></th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($totalSalaries, 2, '.', ' '); ?></th>
            </tr>
        </table>
    </div>
</div>
</body>
</html>

