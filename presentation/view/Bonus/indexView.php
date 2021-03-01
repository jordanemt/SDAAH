<?php
$vars["viewName"] = 'bonus';
include_once 'presentation/public/header.php';
?>

<script src="/presentation/public/js/vacation.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Cálculo de Aguinaldo</h2>
        </div>

        <div class="card-body">

            <hr>

            <form id="form">
                <h4>Datos Personales</h4>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="idEmployee">Identificación del Empleado</label>
                        <select class="form-control form-control-sm selectpicker" data-size="5" id="idEmployee" name="idEmployee" required>
                            <option selected disabled>Seleccione una opción</option>
                            <?php
                            foreach ($vars['employees'] as $value) {
                                ?>
                                <option value="<?= $value['id'] ?>"><?= $value['card'] . ' ' . $value['name'] . ' ' . $value['firstLastName'] . ' ' . $value['secondLastName'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year">Año</label>
                        <select class="form-control form-control-sm selectpicker" id="year" name="year" data-size="5" name="fortnight" required>
                            <?= Util::getSelectYearOptions() ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="completeName">Nombre Completo</label>
                        <input type="text" class="form-control form-control-sm" id="completeName" name="completeName" placeholder="Nombre del Empleado" required disabled>
                    </div>

                </div>

                <h4>Salarios Devengados por Quincena</h4>

                <h6 class="label-hide">Salario #1</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight1">Quincena</label>
                        <select class="form-control form-control-sm selectpicker" data-size="5" id="fortnight1" name="fortnight[]" required>
                            <?= Util::getSelectFortnightOptions(23) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year1">Año</label>
                        <select class="form-control form-control-sm selectpicker" id="year1" name="year[]" data-size="5" required>
                            <?= Util::getSelectYearOptions(intval(date('Y')) - 1) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days1">Días</label>
                        <input type="number" class="form-control form-control-sm" id="days1" name="days[]" min="1" required readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing1">Devengado</label>
                        <input type="text" class="form-control form-control-sm" id="accruing1" name="accruing[]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #2</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight2" class="label-hide">Quincena</label>
                        <select class="form-control form-control-sm selectpicker" data-size="5" id="fortnight2" name="fortnight[]" required>
                            <?= Util::getSelectFortnightOptions(24) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year2" class="label-hide">Año</label>
                        <select class="form-control form-control-sm selectpicker" id="year2" name="year[]" data-size="5" required>
                            <?= Util::getSelectYearOptions(intval(date('Y')) - 1) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days2" class="label-hide">Días</label>
                        <input type="number" class="form-control form-control-sm" id="days2" name="days[]" min="1" required readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing2" class="label-hide">Devengado</label>
                        <input type="text" class="form-control form-control-sm" id="accruing2" name="accruing[]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #3</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight2" class="label-hide">Quincena</label>
                        <select class="form-control form-control-sm selectpicker" data-size="5" id="fortnight2" name="fortnight[]" required>
                            <?= Util::getSelectFortnightOptions(1) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year2" class="label-hide">Año</label>
                        <select class="form-control form-control-sm selectpicker" id="year2" name="year[]" data-size="5" required>
                            <?= Util::getSelectYearOptions(intval(date('Y'))) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days2" class="label-hide">Días</label>
                        <input type="number" class="form-control form-control-sm" id="days2" name="days[]" min="1" required readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing2" class="label-hide">Devengado</label>
                        <input type="text" class="form-control form-control-sm" id="accruing2" name="accruing[]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #4</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year5" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days5" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing5" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #5</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight5" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year5" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days5" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing5" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #6</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnigh6" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year6" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days6" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing6" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #7</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight2" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year2" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days2" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing2" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #8</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight2" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year2" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days2" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing2" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #9</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight3" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year3" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days3" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing3" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #10</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year5" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days5" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing5" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #11</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight5" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year5" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days5" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing5" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #12</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnigh6" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year6" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days6" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing6" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #13</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight2" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year2" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days2" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing2" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #14</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight2" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year2" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days2" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing2" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #15</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight3" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year3" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days3" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing3" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #16</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year5" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days5" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing5" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #17</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight5" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year5" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days5" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing5" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #18</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnigh6" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year6" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days6" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing6" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #19</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight2" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year2" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days2" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing2" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #20</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight2" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year2" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days2" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing2" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #21</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight3" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year3" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days3" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing3" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #22</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year5" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days5" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing5" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #23</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnight5" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year5" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days5" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing5" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #24</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight" class="label-hide">Quincena</label>
                        <select class="form-control" id="fortnigh6" name="fortnights[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year" class="label-hide">Año</label>
                        <input type="number" class="form-control" id="year6" name="years[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days" class="label-hide">Días</label>
                        <input type="number" class="form-control" id="days6" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing" class="label-hide">Devengado</label>
                        <input type="text" class="form-control" id="accruing6" name="accruing[]" required disabled>
                    </div>

                </div>

                <div class="form-row justify-content-end">

                    <div class="form-group col-md-6">
                        <label for="totalSalaries"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control" id="totalSalaries" name="totalSalaries" required disabled>
                    </div>

                </div>

                <h4>Cálculos para Aguinaldo</h4>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="totalVacation">Total Salarios / 12 =</label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalVacation">Menos Pensión Alimenticia</label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalVacation"><strong>A Pagar</strong></label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>

                </div>

                <a class="btn btn-info" href="#" role="button"><i class="fa fa-file"></i> Generar Boleta</a>
            </form>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
