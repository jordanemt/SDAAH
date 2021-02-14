<?php
$vars["viewName"] = 'payroll';
include_once 'presentation/public/header.php';
require_once 'common/Util.php';
?>

<script src="/presentation/public/js/payroll.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Nómina Quincenal</h2>
        </div>

        <div class="card-body">

            <div class="d-flex flex-md-row flex-column">

                <div class="col-md-5 d-flex flex-md-row flex-column justify-content-md-start justify-content-center px-0 py-1">
                    <a class="btn btn-primary mx-1 mb-1-md" href="/payroll/insertView" role="button"><i class="fa fa-folder-plus"></i> Insertar</a>
                    <a class="btn btn-info mx-1" href="#" role="button"><i class="fa fa-file"></i> Generar Boleta</a>
                </div>

                <div class="col-md-7 px-0">

                    <form id="search" class="col-md-12 px-0" method="get">

                        <div class="d-flex flex-md-row flex-column justify-content-md-end">

                            <div class="d-flex flex-row p-1">
                                <label for="fortnight">Quincena:&nbsp</label>
                                <select class="form-control form-control-sm selectpicker" data-size="5" id="fortnight" name="fortnight" onchange="getAllByFilter();">
                                    <?php echo Util::getSelectFortnightOptions() ?>
                                </select>
                            </div>

                            <div class="d-flex flex-row p-1">
                                <label for="year">Año:&nbsp</label>
                                <select class="form-control form-control-sm selectpicker" data-size="5" id="year" name="year" onchange="getAllByFilter();">
                                    <?php echo Util::getSelectYearOptions() ?>
                                </select>
                            </div>

                            <div class="d-flex flex-row p-1">
                                <label for="location">Localidad:&nbsp</label>
                                <select class="form-control form-control-sm selectpicker" id="location" name="location" onchange="getAllByFilter();">
                                    <?php echo Util::getSelectLocationOptions() ?>
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
                        <th class="text-center">Tot. Deducciones</th>
                        <th class="text-center">Neto</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vars['data'] as $value) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $value['completeName'] ?></td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['ordinary'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['vacation'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['extra'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['double'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['surcharges'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['accrued'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['workerCss'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['incomeTax'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['deductions'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <?php echo '₡' . number_format($value['net'], 2, '.', ' '); ?>
                            </td>
                            <td class="text-center">
                                <!--<a href="/payroll/updateView&id=<?php echo $value['id']; ?>"><i class="fa fa-edit"></i> Editar</a>-->
                                <a class="font-warning" href="#" onclick="confirmDelete(<?php echo $value['id']; ?>);"><i class="fa fa-trash-alt"></i> Eliminar</a>
                        </td>
                        <?php 
                    }
                    ?>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
