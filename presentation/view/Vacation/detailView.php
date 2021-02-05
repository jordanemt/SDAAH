<?php
$vars["viewName"] = 'vacation';
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/vacation.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Detalle de Vacaciones</h2>
        </div>

        <div class="card-body">

            <div class="d-flex flex-column">

                <form id="search" class="col-md-12 px-0">

                    <div class="d-flex flex-md-row flex-column justify-content-md-end">

                        <div class="d-flex flex-row p-1">
                            <label for="">Corte:&nbsp</label>
                            <input type="date" class="form-control form-control-sm" id="cutoff" name="cutoff" required>
                        </div>

                    </div>

                </form>

            </div>

            <hr>

            <table id="data-table" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Puesto</th>
                        <th class="text-center">Localidad</th>
                        <th class="text-center">Fecha Ingreso</th>
                        <th class="text-center">Récord</th>
                        <th class="text-center">Días Derecho</th>
                        <th class="text-center">Días Disfrutados</th>
                        <th class="text-center">Saldo Vacaciones</th>
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
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
