<?php
$vars["viewName"] = 'vacation';
include_once 'presentation/public/header.php';
?>

<script src="/presentation/public/js/vacation.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Cálculo de Vacaciones</h2>
        </div>

        <div class="card-body">

            <hr>

            <form id="form" onchange="calcVacationAccrued();">
                <h4>Datos Personales</h4>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="idEmployee">Identificación</label>
                        <select class="form-control selectpicker" data-size="5" id="idEmployee" name="idEmployee" onchange="getPositionEmployee();" required>
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

                    <div class="form-group col-md-3">
                        <label for="vacationDate">Fecha Vacaciones</label>
                        <input type="date" class="form-control" id="vacationDate" name="vacationDate" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="vacationDays">Días</label>
                        <input type="tex" class="form-control numberMask" id="vacationDays" name="vacationDays" placeholder="Días" min="1" required>
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="vacationFortnight">Quincena</label>
                        <select class="form-control selectpicker" data-size="5" id="vacationFortnight" name="vacationFortnight" required>
                            <?= Util::getSelectFortnightOptions() ?>
                        </select>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="completeName">Nombre Completo</label>
                        <input type="text" class="form-control" id="completeName" name="completeName" placeholder="Nombre del Empleado" required disabled>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="admissionDate">Fecha Ingreso</label>
                        <input type="date" class="form-control" id="admissionDate" name="admissionDate" placeholder="Fecha de Ingreso" required disabled>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="position">Puesto</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="Puesto" required disabled>
                    </div>                    

                </div>

                <h4>Salario Base para el Cálculo</h4>

                <h6 class="label-hide">Salario #1</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label>Quincena</label>
                        <select class="form-control selectpicker" data-size="5" name="fortnight[]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(6, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Año</label>
                        <select class="form-control selectpicker" data-size="5" name="year[]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Días</label>
                        <input type="text" class="form-control numberMask" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing0">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing0" name="accruing[]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #2</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker" data-size="5" name="fortnight[]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(5, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker" data-size="5" name="year[]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing1" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing1" name="accruing[]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #3</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker" data-size="5" name="fortnight[]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(4, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker" data-size="5" name="year[]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing2" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing2" name="accruing[]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #4</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker" data-size="5" name="fortnight[]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(3, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker" data-size="5" name="year[]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing3" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing3" name="accruing[]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #5</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker" data-size="5" name="fortnight[]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(2, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker" data-size="5" name="year[]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing4" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing4" name="accruing[]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #6</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker" data-size="5" name="fortnight[]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(1, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker" data-size="5" name="year[]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing5" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing5" name="accruing[]" required readonly>
                    </div>

                </div>

                <div class="form-row justify-content-end">
                    
                    <div class="form-group col-md-4">
                        <label for="avgSalary"><strong>Sala. Prom. Diario</strong></label>
                        <input type="text" class="form-control" id="avgSalary" name="avgSalary" required readonly>
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="daysTotal"><strong>Total Días</strong></label>
                        <input type="text" class="form-control" id="daysTotal" name="daysTotal" required readonly>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="salaryTotal"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control" id="salaryTotal" name="salaryTotal" required readonly>
                    </div>

                </div>
                
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="accruedVacation"><strong>Devengado Vacac.</strong></label>
                        <input type="text" class="form-control" id="accruedVacation" name="accruedVacation" required readonly>
                    </div>

                </div>
                
                <h4>Detalle de Deducciones</h4>
                
                <div class="form-row">
                    
                    <div id="deductionsSelector" class="form-group col-md-4">
                        <label for="deductions">Agregar Deducciones</label>
                        <select class="form-control selectpicker" multiple data-size="5" title="Seleccione ninguna o varias" id="deductions" name="deductions[]" onchange="addDeductions();">
                            <?php
                            foreach ($vars['deductions'] as $value) {
                                ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php
                            }
                            if (count($vars['deductions']) == 0) {
                                ?>
                                <option disabled>No hay deducciones en el catálogo</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="workerCCSS">Cuota CCSS</label>
                        <input type="text" class="form-control" id="workerCCSS" name="workerCCSS" required disabled>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="incomeTax">Imp. Sobre la Renta</label>
                        <input type="text" class="form-control" id="incomeTax" name="incomeTax" required disabled>
                    </div>

                    <?php
                    foreach ($vars['deductions'] as $value) {
                        ?>
                        <div id="deduction-form-group-<?= $value['id'] ?>" class="form-group col-md-4 deductions">
                            <label for="deduction-<?= $value['id'] ?>"><?= $value['name'] ?></label>
                            <input type="text" class="form-control moneyMask deduction-input" id="deduction-<?= $value['id'] ?>" name="deductionsMounts[]" disabled>
                        </div>
                        <?php
                    }
                    ?>

                    <script>$(".deductions").hide();</script>

                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="deductionsTotal"><strong>Total Deducciones</strong></label>
                        <input type="text" class="form-control" id="deductionsTotal" name="deductionsTotal" required readonly>
                    </div>
                    
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="net"><strong>Total Vacac. Neto a Pagar</strong></label>
                        <input type="text" class="form-control" id="net" name="net" required readonly>
                    </div>
                    
                </div>

                <a class="btn btn-info mx-1" href="#" role="button"><i class="fa fa-file"></i> Generar Boleta</a>
            </form>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
