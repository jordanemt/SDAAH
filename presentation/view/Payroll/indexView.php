<?php

$vars["payroll-view"] = true;
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/payroll.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Nómina Quincenal</h2>
        </div>

        <div class="card-body">

            <div class="d-flex flex-md-row flex-column">

                <div class="col-md-3 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <a class="btn btn-primary mx-1" href="?controller=payroll&action=insertView" role="button"><i class="fa fa-folder-plus"></i> Insertar</a>
                    <a class="btn btn-info mx-1" href="#" role="button"><i class="fa fa-file"></i> Generar Boleta</a>
                </div>

                <div class="col-md-9 px-0">

                    <form id="search" class="col-md-12 px-0">

                        <div class="d-flex flex-md-row flex-column justify-content-md-end">
                            
                            <div class="d-flex flex-row p-1">
                                <label for="">Quincena:&nbsp</label>
                                <select class="form-control form-control-sm">
                                    <option>Q-1</option>
                                </select>
                            </div>
                            
                            <div class="d-flex flex-row p-1">
                                <label for="">Año:&nbsp</label>
                                <select class="form-control form-control-sm">
                                    <option>2020</option>
                                </select>
                            </div>
                            
                            <div class="d-flex flex-row p-1">
                                <label for=""">Localidad:&nbsp</label>
                                <select class="form-control form-control-sm">
                                    <option>Todas</option>
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
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Ordinario</th>
                        <th class="text-center">Vacación</th>
                        <th class="text-center">Extra</th>
                        <th class="text-center">Doble</th>
                        <th class="text-center">Recargo</th>
                        <th class="text-center">Tot. Devengado</th>
                        <th class="text-center">Seguro Social</th>
                        <th class="text-center">Imp. Renta</th>
                        <th class="text-center">Anticipos</th>
                        <th class="text-center">Tot. Deducciones</th>
                        <th class="text-center">Neto</th>
                        <th class="text-center">Acción</th>
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
                        <td class="text-center">
                            <a href="?controller=payroll&action=updateView"><i class="fa fa-edit"></i> Editar</a>
                            <a class="font-warning" href="#" onclick="confirmDelete()();"><i class="fa fa-trash-alt"></i> Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
