<?php
$vars["viewName"] = 'liquidation';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Cálculo de Liquidación</h2>
        </div>

        <div class="card-body">

            <hr>

            <form id="formLiquidation">
                <h4>Datos Personales</h4>

                <input class="d-none" id="card" name="card" required />

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="idEmployee">Identificación</label>
                        <select class="form-control selectpicker" data-size="5" id="idEmployee" name="idEmployee" onchange="chargeEmployeeDataOnLiquidation();" required>
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
                        <label for="admissionDate">Fecha Ingreso</label>
                        <input type="date" class="form-control" id="admissionDate" name="admissionDate" placeholder="Fecha de Ingreso" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="departureDate">Fecha de Salida</label>
                        <input type="date" class="form-control active-onchange-liquidation" id="departureDate" name="departureDate" value="<?= date('Y-m-d') ?>" onchange="calcRecord();" required>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="record">Récord</label>
                        <input type="text" class="form-control" id="record" name="record" placeholder="Record" required>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="completeName">Nombre Completo</label>
                        <input type="text" class="form-control" id="completeName" name="completeName" placeholder="Nombre del Empleado" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="reason">Motivo</label>
                        <select class="form-control" id="reason" name="reason" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="Renuncia Voluntaria">Renuncia Voluntaria</option>
                            <option value="Despido con Responsabilidad Patronal">Despido con Responsabilidad Patronal</option>
                            <option value="Despido sin Responsabilidad Patronal">Despido sin Responsabilidad Patronal</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="position">Puesto</label>
                        <input type="text" class="form-control active-onchange-liquidation" id="position" name="position" placeholder="Puesto" readonly required>
                    </div>                    

                </div>

                <h4>Cálculo de Vacaciones</h4>

                <h6 class="label-hide">Salario #1</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label>Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="vacations[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(6, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Año</label>
                        <select class="form-control selectpicke active-onchange-liquidation" data-size="5" name="vacations[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="vacations[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing0">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing0" name="vacations[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #2</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="vacations[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(5, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicke active-onchange-liquidation" data-size="5" name="vacations[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="vacations[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing1" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing1" name="vacations[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #3</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="vacations[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(4, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicke active-onchange-liquidation" data-size="5" name="vacations[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="vacations[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing2" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing2" name="vacations[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #4</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="vacations[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(3, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicke active-onchange-liquidation" data-size="5" name="vacations[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="vacations[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing3" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing3" name="vacations[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #5</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="vacations[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(2, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicke active-onchange-liquidation" data-size="5" name="vacations[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="vacations[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing4" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing4" name="vacations[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #6</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="vacations[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(1, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicke active-onchange-liquidation" data-size="5" name="vacations[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="vacations[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing5" class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing5" name="vacations[accruing][]" required readonly>
                    </div>

                </div>

                <div class="form-row justify-content-end">

                    <div class="form-group col-md-4">
                        <label for="avgSalaryVacation"><strong>Sala. Prom. Diario</strong></label>
                        <input type="text" class="form-control moneyMask" id="avgSalaryVacation" name="vacations[avgSalary]" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="daysTotalVacation"><strong>Total Días</strong></label>
                        <input type="text" class="form-control moneyMask" id="daysTotalVacation" name="vacations[daysTotal]" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="salaryTotalVacation"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control moneyMask" id="salaryTotalVacation" name="vacations[salaryTotal]" required>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="accruedVacation"><strong>Devengado Vacac.</strong></label>
                        <input type="text" class="form-control moneyMask" id="accruedVacation" name="vacations[accruedVacation]" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="pendingVacationDays"><strong>Vacac. Pend.</strong></label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" id="pendingVacationDays" name="vacations[vacationDays]" value="0" required>
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
                        <input type="text" class="form-control moneyMask" id="workerCCSS" name="workerCCSS" required readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="incomeTax">Imp. Sobre la Renta</label>
                        <input type="text" class="form-control moneyMask" id="incomeTax" name="incomeTax" required readonly>
                    </div>

                    <?php
                    foreach ($vars['deductions'] as $value) {
                        ?>
                        <div id="deduction-form-group-<?= $value['id'] ?>" class="form-group col-md-4 deductions">
                            <label for="deduction-<?= $value['id'] ?>"><?= $value['name'] ?></label>
                            <input type="text" class="form-control moneyMask deduction-input active-onchange-liquidation" id="deduction-<?= $value['id'] ?>" name="deductionsMounts[]" disabled>
                        </div>
                        <?php
                    }
                    ?>

                    <script>$(".deductions").hide();</script>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="deductionsTotal"><strong>Total Deducciones</strong></label>
                        <input type="text" class="form-control moneyMask" id="deductionsTotal" name="deductionsTotal" required readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="netVacation"><strong>Neto Vacac. Proporcionales</strong></label>
                        <input type="text" class="form-control moneyMask" id="netVacation" name="netVacation" required readonly>
                    </div>

                </div>

                <h4>Cálculo de Pre-aviso y Cesantía</h4>

                <h6 class="label-hide">Salario #1</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label>Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(12, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing6" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #2</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(11, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing7" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #3</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(10, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing8" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #4</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(9, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing9" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #5</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(8, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing10" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #6</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(7, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing11" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #7</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(6, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing12" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #8</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(5, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing13" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #9</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(4, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing14" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #10</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(3, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing15" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #11</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(2, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing16" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <h6 class="label-hide">Salario #12</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label class="label-hide">Quincena</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]" required>
                            <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(1, $year)) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Año</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[year][]" required>
                            <?= Util::getSelectYearOptions($year) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="label-hide">Días</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="label-hide">Devengado</label>
                        <input type="text" class="form-control moneyMask" id="accruing17" name="preCen[accruing][]" required readonly>
                    </div>

                </div>

                <div class="form-row justify-content-end">

                    <div class="form-group col-md-4">
                        <label for="avgSalaryPreCen"><strong>Sala. Prom. Diario</strong></label>
                        <input type="text" class="form-control moneyMask" id="avgSalaryPreCen" name="preCen[avgSalary]" required readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="daysTotalPreCen"><strong>Total Días</strong></label>
                        <input type="text" class="form-control numberMask" id="daysTotalPreCen" name="preCen[daysTotal]" required readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="salaryTotalPreCen"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control moneyMask" id="salaryTotalPreCen" name="preCen[salaryTotal]" required readonly>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="preDays">Días Pre-aviso</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" id="preDays" name="preCen[preDays]" value="0" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalPre"><strong>Tot. Días Pre-aviso</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalPre" name="preCen[totalPre]" required readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="cenDays">Días Cesantía</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" id="cenDays" name="preCen[cenDays]" value="0" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalCen"><strong>Tot. Días Cesantía</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalCen" name="preCen[totalCen]" required readonly>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="totalPreCen"><strong>Total Devengado Pre-aviso y Cesantia</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalPreCen" name="preCen[totalPreCen]" required readonly>
                    </div>

                </div>

                <h4>Cálculo de Aguinaldo</h4>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="bonusYear">Año del Aguinaldo</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" id="bonusYear" name="bonusYear">
                            <?= Util::getSelectYearOptions() ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalSalariesBonus"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalSalariesBonus" name="totalSalariesBonus" required readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalBonus"><strong>Tot. Deven. Aguinaldo</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalBonus" name="totalBonus" required readonly>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="toPay"><strong>A Pagar Prestaciones Legales</strong></label>
                        <input type="text" class="form-control moneyMask" id="toPay" name="toPay" required readonly>
                    </div>

                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="dowloadLiquidationVaucher();">Descargar Boleta</button>
            </form>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
