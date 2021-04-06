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

            .footer p{
                margin: 0px;
                margin-bottom: 5px;
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
                        <h4><strong><u>Cálculo de Aguinaldo</u></strong></h4>
                    </td>
                    <td style="width: 20%;"></td>
                </tr>
            </table>
        </div>

        <div class="body">
            <table>
                <tr>
                    <th style="width: 10%; text-align: center;" class="border">Cédula:</th>
                    <td style="width: 10%; text-align: center;" class="border"><?= $data['employee']['card'] ?></td>
                    <th style="width: 10%; text-align: center;" class="border">Nombre:</th>
                    <td style="width: 57%; text-align: center;" class="border"><?= $data['employee']['firstLastName'] . ' ' . $data['employee']['secondLastName'] . ' ' . $data['employee']['name'] ?></td>
                    <th style="width: 5%; text-align: center;" class="border">Año:</th>
                    <td style="width: 8%; text-align: center;" class="border"><?= $data['year'] ?></td>
                </tr>
            </table>

            <br>
            <table>
                <tr>
                    <th style="width: 100%; text-align: center;" class="border">Salarios Devengados por Quincena:</th>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 20%; text-align: center;" class="border">Quincena</th>
                    <th style="width: 20%; text-align: center;" class="border">Año</th>
                    <th style="width: 60%; text-align: center;" class="border">Devengando</th>
                </tr>

                <?php
                foreach ($data['payments'] as $key => $payment) {
                    if (!empty($payment)) {
                        ?>
                        <tr>
                            <td style="width: 20%; text-align: center;" class="border">Q-<?= $payment['fortnight'] ?></td>
                            <td style="width: 20%; text-align: center;" class="border"><?= $payment['year'] ?></td>
                            <td style="width: 60%; text-align: center;" class="border">
                                <img src="<?= $currencyPath ?>" height="12">
                                <?= number_format($payment['net'], 2, '.', ' '); ?>
                            </td>
                        </tr>
                        <?php
                    } else {
                        ?>
                        <tr>
                            <td style="width: 20%; text-align: center;" class="border">Q-<?= $key < 2 ? $key + 23 : $key - 1; ?></td>
                            <td style="width: 20%; text-align: center;" class="border"><?= $key < 2 ? $data['year'] - 1 : $data['year'] ?></td>
                            <td style="width: 60%; text-align: center;" class="border">
                                <img src="<?= $currencyPath ?>" height="12">
                                0.00
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>

            </table>

            <table>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Total Salarios:</th>
                    <td style="width: 60%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['accruing'], 2, '.', ' '); ?>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Dividido entre 12 =</th>
                    <td style="width: 60%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['grossBonus'], 2, '.', ' '); ?>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">Menos Pensión Alimenticia:</th>
                    <td style="width: 60%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= !empty($data['alimony']) ? number_format($data['alimony'], 2, '.', ' ') : '0.00'; ?></td>
                </tr>
                <tr>
                    <th style="width: 40%; text-align: center;" class="border">A pagar: </th>
                    <td style="width: 60%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['net'], 2, '.', ' '); ?>
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width: 100%; text-align: center;" class="border">
                        <?= Util::convertToLetter($data['net']) ?>
                    </td>
                </tr>
            </table>

            <br>
            <table class="footer">
                <tr>
                    <td style="width: 100%; text-align: justify; font-size: 10px;" class="border">
                        <p><strong>Ley 2412:</strong></p>
                        <p><strong>Artículo 1:</strong> Todo patrono está obligado a conceder a sus trabajadores, de cualquier clase que sean y cualquiera
                            que sea la forma en que desempeñen sus labores y en que se les pague el salario, un beneficio económico anual
                            equivalente a un mes de salario.</p>
                        <p><strong>Artículo 2:</strong> Este será calculado con base en el promedio de los sueldos ordinarios y extraordinarios devengados por
                            la persona, durante los doce meses anteriores al 1° de diciembre del año de que se trate, y para efectuar tales
                            cálculos no se tomarán en cuenta, en ningún caso, las sumas que se hayan percibido del beneficio a que se refiere
                            esta ley.</p>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
