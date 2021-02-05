<?php
$vars["viewName"] = 'payroll';
include_once 'presentation/public/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: ?controller=Index');
}
?>

<script src="presentation/public/js/payroll.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Reporte Consolidado</h2>
        </div>

        <div class="card-body">
            
            <a href="?controller=Payroll&action=detailProvisionReportView">Detalle por Empleado <i class="fa fa-angle-double-right"></i></a>

            <div class="d-flex flex-md-row flex-column">

                <div class="col-md-6 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <a class="btn btn-info mx-1" href="#" role="button"><i class="fa fa-file"></i> Generar Boleta</a>
                    <a class="btn btn-info mx-1" href="#" role="button"><i class="fa fa-upload"></i> Enviar Reporte</a>
                </div>

                <div class="col-md-6 px-0">

                    <form id="search" class="col-md-12 px-0">

                        <div class="d-flex flex-md-row flex-column justify-content-md-end">
                            
                            <div class="d-flex flex-row p-1">
                                <label for="">Mes:&nbsp</label>
                                <select class="form-control form-control-sm">
                                    <option>Enero</option>
                                </select>
                            </div>
                            
                            <div class="d-flex flex-row p-1">
                                <label for="">Año:&nbsp</label>
                                <select class="form-control form-control-sm">
                                    <option>2020</option>
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
                        <th class="text-center">Localidad</th>
                        <th class="text-center">Salario Devengado</th>
                        <th class="text-center">CCSS 26,33%</th>
                        <th class="text-center">Aguinaldo 8,33%</th>
                        <th class="text-center">Vacaciones 4,16%</th>
                        <th class="text-center">Cesantía 8,33%</th>
                        <th class="text-center">Ley PT 4,75%</th>
                        <th class="text-center">Total 52,24%</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
