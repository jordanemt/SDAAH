<?php
$vars["viewName"] = 'user';
include_once 'presentation/public/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: ?controller=Index');
}
?>

<script src="presentation/public/js/user.js" type="text/javascript"></script>

<div class="container my-4">

    <div class="card">
        <div class="card-header text-center">
            <h2>Lista de Usuarios</h2>
        </div>
        <div class="card-body">

            <div class="d-flex justify-content-md-start justify-content-center">
                <a class="btn btn-primary" href="?controller=User&action=insertView" role="button"><i class="fa fa-folder-plus"></i> Insertar</a>
            </div>

            <hr>

            <table id="data-table" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">Cédula</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">P/Apellido</th>
                        <th class="text-center">S/Apellido</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Rol</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $value['card'] ?></td>
                            <td class="text-center"><?php echo $value['name'] ?></td>
                            <td class="text-center"><?php echo $value['firstLastName'] ?></td>
                            <td class="text-center"><?php echo $value['secondLastName'] ?></td>
                            <td class="text-center"><?php echo $value['email'] ?></td>
                            <td class="text-center">
                                <?php
                                switch ($value['role']) {
                                    case 1:
                                        echo 'Consultor';
                                        break;

                                    case 2:
                                        echo 'Digitador';
                                        break;

                                    case 3:
                                        echo 'Administrador';
                                        break;
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="?controller=User&action=updateView&id=<?php echo $value['id'] ?>" class=""><i class="fa fa-edit"></i> Editar</a>
                                <a href="#" class="font-warning" onclick="confirmDelete(<?php echo $value['id'] ?>);"><i class="fa fa-trash-alt"></i> Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
