<?php
$vars["viewName"] = 'bonus';
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/payroll.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Detalle de Aguinaldos</h2>
        </div>

        <div class="card-body">

            <div class="d-flex flex-md-row flex-column">

                <div class="col-md-12 px-0">

                    <form id="search" class="col-md-12 px-0">

                        <div class="d-flex flex-md-row flex-column justify-content-md-end">
                            
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
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">Cuenta Bancaria</th>
                        <th class="text-center">Diciembre</th>
                        <th class="text-center">Enero</th>
                        <th class="text-center">Febrero</th>
                        <th class="text-center">Marzo</th>
                        <th class="text-center">Abril</th>
                        <th class="text-center">Mayo</th>
                        <th class="text-center">Junio</th>
                        <th class="text-center">Julio</th>
                        <th class="text-center">Agosto</th>
                        <th class="text-center">Septiembre</th>
                        <th class="text-center">Octubre</th>
                        <th class="text-center">Noviembre</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Aguinaldo Bruto</th>
                        <th class="text-center">Pensión Alimenticia</th>
                        <th class="text-center">Aguinaldo Neto</th>
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
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
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
