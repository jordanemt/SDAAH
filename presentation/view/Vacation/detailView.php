<?php
$vars["viewName"] = 'vacation';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Detalle de Vacaciones</h2>
        </div>

        <div class="card-body">

            <div class="d-flex flex-column">

                <form id="search" class="col-md-12 px-0" action="" method="get">

                    <input class="d-none" type="text" name="controller" value="vacation" readonly>

                    <input class="d-none" type="text" name="action" value="detail" readonly>

                    <div class="d-flex flex-md-row flex-column justify-content-md-end">

                        <div class="d-flex flex-row p-1">
                            <label for="">Corte:&nbsp</label>
                            <input type="date" class="form-control form-control-sm" id="cutoff" name="cutoff" onchange="submitSearch();" value="<?= $vars['cutoff'] ?>" required>
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
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $value['card'] ?></td>
                            <td class="text-center"><?= $value['completeName'] ?></td>
                            <td class="text-center"><?= $value['name'] ?></td>
                            <td class="text-center"><?= $value['location'] ?></td>
                            <td class="text-center"><?= $value['admissionDate'] ?></td>
                            <td class="text-center"><?= $value['record'] ?></td>
                            <td class="text-center"><?= $value['daysRight'] ?></td>
                            <td class="text-center"><?= !empty($value['vacationsDays']) ? $value['vacationsDays'] : 0 ?></td>
                            <td class="text-center"><?= $value['vacationBalance'] ?></td>
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
