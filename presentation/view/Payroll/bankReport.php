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
                <h4><strong><u>Reporte Bancario</u></strong></h4>
            </td>
            <td style="width: 20%;"></td>
        </tr>
    </table>
</div>

<div>
    <div style="width: 200px; padding-bottom: 10px">
        <table>
            <tr>
                <th class="border" style="width: 40%">Quincena</th>
                <td style="text-align: center; width: 60%;" class="border"><?= $data['data'][0]['fortnight'] ?></td>
            </tr>

            <tr>
                <th class="border" style="width: 40%">Año</th>
                <td style="text-align: center; width: 60%;" class="border"><?= $data['data'][0]['year'] ?></td>
            </tr>
        </table>
    </div>

    <div>
        <table>
            <colgroup>
                <col style="width: 70px;">
                <col style="width: 180px;">
                <col style="width: 55px;">
                <col style="width: 120px;">
                <col style="width: 90px;">
            </colgroup>
            <tr>
                <th class="border" style="text-align: center;">Cédula</th>
                <th class="border" style="text-align: center;">Nombre Completo</th>
                <th class="border" style="text-align: center;">Banco</th>
                <th class="border" style="text-align: center;">Cta Banco</th>
                <th class="border" style="text-align: center;">Monto</th>
            </tr>

            <?php
            $total = 0;
            foreach ($data['data'] as $value) {
                ?>
                <tr>
                    <td class="border" style="text-align: center;"><?= $value['card'] ?></td>
                    <td class="border" style="text-align: center;"><?= $value['completeName'] ?></td>
                    <td class="border" style="text-align: center;"><?= $value['bank'] ?></td>
                    <td class="border" style="text-align: center;"><?= $value['bankAccount'] ?></td>
                    <td class="border" style="text-align: center;">
                        <?= '₡' . number_format($value['net'], 2, '.', ' '); ?>
                    </td>
                </tr>
                <?php
                $total += $value['net'];
            }
            ?>
            <tr>
                <th class="border" style="text-align: center;">Totales</th>
                <th class="border" style="text-align: center;">---</th>
                <th class="border" style="text-align: center;">---</th>
                <th class="border" style="text-align: center;">---</th>
                <th class="border" style="text-align: center;"><?= '₡' . number_format($total, 2, '.', ' '); ?></th>
            </tr>
        </table>
    </div>
</div>
</body>