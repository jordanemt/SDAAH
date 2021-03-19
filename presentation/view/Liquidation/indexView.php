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
                        <label id="idEmployee-error" class="error" for="idEmployee" style="display: none;">Este campo es necesario</label>
                        <div class="loading-div"></div>
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
                
                <?php
                for ($i = 0; $i < 6; $i++) {
                    ?>
                    <h6 class="label-hide">Salario #<?= $i + 1 ?></h6>

                    <div class="form-row">

                        <div class="form-group col-md-2">
                            <label <?= $i == 0 ? '' : 'class="label-hide"'; ?>>Quincena</label>
                            <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="vacations[fortnight][]">
                                <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(6 - $i, $year)) ?>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label <?= $i == 0 ? '' : 'class="label-hide"'; ?>>Año</label>
                            <select class="form-control selectpicke active-onchange-liquidation" data-size="5" name="vacations[year][]">
                                <?= Util::getSelectYearOptions($year) ?>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label <?= $i == 0 ? '' : 'class="label-hide"'; ?>>Días</label>
                            <input type="text" class="form-control numberMask active-onchange-liquidation" name="vacations[days][]" min="1" value="15">
                        </div>

                        <div class="form-group col-md-6">
                            <label <?= $i == 0 ? '' : 'class="label-hide"'; ?>>Devengado</label>
                            <input type="text" class="form-control moneyMask" id="accruing<?= $i ?>" name="vacations[accruing][]" readonly>
                        </div>

                    </div>
                    <?php
                }
                ?>

                <div class="form-row justify-content-end">

                    <div class="form-group col-md-4">
                        <label for="avgSalaryVacation"><strong>Sala. Prom. Diario</strong></label>
                        <input type="text" class="form-control moneyMask" id="avgSalaryVacation" name="vacations[avgSalary]" readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="daysTotalVacation"><strong>Total Días</strong></label>
                        <input type="text" class="form-control numberMask" id="daysTotalVacation" name="vacations[daysTotal]" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="salaryTotalVacation"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control moneyMask" id="salaryTotalVacation" name="vacations[salaryTotal]" readonly>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="accruedVacation"><strong>Devengado Vacac.</strong></label>
                        <input type="text" class="form-control moneyMask" id="accruedVacation" name="vacations[accruedVacation]" readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="pendingVacationDays"><strong>Vacac. Pend.</strong></label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" id="pendingVacationDays" name="vacations[vacationDays]" required>
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
                        <input type="text" class="form-control moneyMask" id="workerCCSS" name="workerCCSS" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="incomeTax">Imp. Sobre la Renta</label>
                        <input type="text" class="form-control moneyMask" id="incomeTax" name="incomeTax" readonly>
                    </div>

                    <?php
                    foreach ($vars['deductions'] as $value) {
                        ?>
                        <div id="deduction-form-group-<?= $value['id'] ?>" class="form-group col-md-4 deductions">
                            <label for="deduction-<?= $value['id'] ?>"><?= $value['name'] ?></label>
                            <input type="text" class="form-control moneyMask deduction-input active-onchange-liquidation" id="deduction-<?= $value['id'] ?>" name="deductionsMounts[]" required disabled>
                        </div>
                        <?php
                    }
                    ?>

                    <script>$(".deductions").hide();</script>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="deductionsTotal"><strong>Total Deducciones</strong></label>
                        <input type="text" class="form-control moneyMask" id="deductionsTotal" name="deductionsTotal" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="netVacation"><strong>Neto Vacac. Proporcionales</strong></label>
                        <input type="text" class="form-control moneyMask" id="netVacation" name="netVacation" readonly>
                    </div>

                </div>

                <h4>Cálculo de Pre-aviso y Cesantía</h4>
                
                <?php
                for ($i = 6; $i < 18; $i++) {
                    ?>
                    <h6 class="label-hide">Salario #<?= $i -5 ?></h6>

                    <div class="form-row">

                        <div class="form-group col-md-2">
                            <label <?= $i == 6 ? '' : 'class="label-hide"'; ?>>Quincena</label>
                            <select class="form-control selectpicker active-onchange-liquidation" data-size="5" name="preCen[fortnight][]">
                                <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(18 - $i, $year)) ?>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label <?= $i == 6 ? '' : 'class="label-hide"'; ?>>Año</label>
                            <select class="form-control selectpicke active-onchange-liquidation" data-size="5" name="preCen[year][]">
                                <?= Util::getSelectYearOptions($year) ?>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label <?= $i == 6 ? '' : 'class="label-hide"'; ?>>Días</label>
                            <input type="text" class="form-control numberMask active-onchange-liquidation" name="preCen[days][]" min="1" value="15">
                        </div>

                        <div class="form-group col-md-6">
                            <label <?= $i == 6 ? '' : 'class="label-hide"'; ?>>Devengado</label>
                            <input type="text" class="form-control moneyMask" id="accruing<?= $i ?>" name="preCen[accruing][]" readonly>
                        </div>

                    </div>
                    <?php
                }
                ?>

                <div class="form-row justify-content-end">

                    <div class="form-group col-md-4">
                        <label for="avgSalaryPreCen"><strong>Sala. Prom. Diario</strong></label>
                        <input type="text" class="form-control moneyMask" id="avgSalaryPreCen" name="preCen[avgSalary]" readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="daysTotalPreCen"><strong>Total Días</strong></label>
                        <input type="text" class="form-control numberMask" id="daysTotalPreCen" name="preCen[daysTotal]" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="salaryTotalPreCen"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control moneyMask" id="salaryTotalPreCen" name="preCen[salaryTotal]" readonly>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="preDays">Días Pre-aviso</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" id="preDays" name="preCen[preDays]" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalPre"><strong>Tot. Días Pre-aviso</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalPre" name="preCen[totalPre]" readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="cenDays">Días Cesantía</label>
                        <input type="text" class="form-control numberMask active-onchange-liquidation" id="cenDays" name="preCen[cenDays]" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalCen"><strong>Tot. Días Cesantía</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalCen" name="preCen[totalCen]" readonly>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="totalPreCen"><strong>Total Devengado Pre-aviso y Cesantia</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalPreCen" name="preCen[totalPreCen]" readonly>
                    </div>

                </div>

                <h4>Cálculo de Aguinaldo</h4>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="bonusYear">Año del Aguinaldo</label>
                        <select class="form-control selectpicker active-onchange-liquidation" data-size="5" id="bonusYear" name="bonusYear">
                            <?= Util::getSelectYearOptions(date('Y')) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalSalariesBonus"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalSalariesBonus" name="totalSalariesBonus" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalBonus"><strong>Tot. Deven. Aguinaldo</strong></label>
                        <input type="text" class="form-control moneyMask" id="totalBonus" name="totalBonus" readonly>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="toPay"><strong>A Pagar Prestaciones Legales</strong></label>
                        <input type="text" class="form-control moneyMask" id="toPay" name="toPay" readonly>
                    </div>

                </div>
                
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-spinner fa-spin"></i> Calculando...
                </div>
                <script>$('.alert').hide();</script>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="dowloadLiquidationVaucher();">Descargar Boleta</button>
            </form>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
