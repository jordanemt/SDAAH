<?php

$vars["employee-view"] = true;
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/employee.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">
        
        <div class="card-header text-center">
            <h2>Lista de Empleados</h2>
        </div>
        
        <div class="card-body">
            
            <a class="btn btn-primary" href="?controller=employee&action=insertView" role="button"><i class="fa fa-folder-plus"></i> Insertar</a>
            
            <hr>
            
            <table id="data-table" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">P/Apellido</th>
                        <th class="text-center">S/Apellido</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Sexo</th>
                        <th class="text-center">Puesto</th>
                        <th class="text-center">Localidad</th>
                        <th class="text-center">N/Cuenta</th>
                        <th class="text-center">F/Nacimiento</th>
                        <th class="text-center">F/Ingreso</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Salario</th>
                        <th class="text-center">Hora Ordinaria</th>
                        <th class="text-center">Hora Extra</th>
                        <th class="text-center">Hora Doble</th>
                        <th class="text-center">Liquidado</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Afiliado</th>
                        <th class="text-center">CSS/INS</th>
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
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">Dato prueba</td>
                        <td class="text-center">
                            <a href="?controller=employee&action=updateView"><i class="fa fa-edit"></i> Editar</a>
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
