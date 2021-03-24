<?php
$currencyPath = 'presentation/public/img/colon.png';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Comprobante de Ingreso a Planilla</title>

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
                        <h4><strong><u>Comprobante de Ingreso a Planillas</u></strong></h4>
                    </td>
                    <td style="width: 20%;"></td>
                </tr>
            </table>
        </div>

        <div class="body">
            <table>
                <tr>
                    <th style="width: 13%; text-align: center;" class="border">#Cédula:</th>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['card'] ?></td>
                    <th style="width: 13%; text-align: center;" class="border">Nombre:</th>
                    <td style="width: 54%; text-align: center;" class="border"><?= $data['firstLastName'] . ' ' . $data['secondLastName'] . ' ' . $data['name'] ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 13%; text-align: center;" class="border">Puesto:</th>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['position']['name'] ?></td>
                    <th style="width: 13%; text-align: center;" class="border">Salario:</th>
                    <td style="width: 21%; text-align: center;" class="border">
                        <img src="<?= $currencyPath ?>" height="12">
                        <?= number_format($data['position']['salary'], 2, '.', ' '); ?>
                    </td>
                    <th style="width: 13%; text-align: center;" class="border">Localidad:</th>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['location'] ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 13%; text-align: center;" class="border">Sexo:</th>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['gender'] ?></td>
                    <th style="width: 13%; text-align: center;" class="border">Tipo:</th>
                    <td style="width: 21%; text-align: center;" class="border"><?= $data['position']['type'] ?></td>
                    <th style="width: 13%; text-align: center;" class="border">Afiliado:</th>
                    <td style="width: 20%; text-align: center;" class="border"><?= $data['isAffiliated'] ? 'Sí' : 'No'; ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th style="width: 13%; text-align: center;" class="border">Ingreso:</th>
                    <td style="width: 20%; text-align: center;" class="border"><?= date('d-m-Y', strtotime($data['admissionDate'])) ?></td>
                    <th style="width: 13%; text-align: center;" class="border">Nacimiento:</th>
                    <td style="width: 21%; text-align: center;" class="border"><?= date('d-m-Y', strtotime($data['birthdate'])) ?></td>
                    <td style="width: 33%;"></td>
                </tr>
            </table>
            
            <table>
                <tr>
                    <th style="width: 13%; text-align: center;" class="border">#Cuenta:</th>
                    <td style="width: 20%; text-align: center;" class="border"><?= Util::maskAccount($data['bankAccount']); ?></td>
                    <th style="width: 13%; text-align: center;" class="border">email:</th>
                    <td style="width: 54%; text-align: center;" class="border"><?= $data['email'] ?></td>
                </tr>
            </table>
            
            <table>
                <tr>
                    <th style="width: 13%; text-align: center;" class="border">Ingresado:</th>
                    <td style="width: 20%; text-align: center;" class="border"></td>
                    <th style="width: 13%; text-align: center;" class="border">Aprobado:</th>
                    <td style="width: 32%; text-align: center;" class="border"></td>
                    <td style="width: 22%; text-align: center;" class="border"><?= date('d-m-Y') ?></td>
                </tr>
            </table>
            
            <br>
            <table>
                <tr>
                    <td style="width: 10%;"></td>
                    <td style="width: 32%; text-align: right;"><strong>Firma del empleado:</strong></td>
                    <td style="width: 1%;"></td>
                    <td style="width: 35%; border-bottom: 1px solid;"></td>
                    <td style="width: 22%;"></td>
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
