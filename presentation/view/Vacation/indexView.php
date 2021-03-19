<?php
$vars["viewName"] = 'vacation';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Cálculo de Vacaciones</h2>
        </div>

        <div class="card-body">

            <hr>

            <form id="formVacation" method="get" action="">
                
                <h4>Datos Personales</h4>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="idEmployee">Identificación</label>
                        <select class="form-control selectpicker" data-size="5" id="idEmployee" name="idEmployee" onchange="chargeEmployeeDataOnVacation();" required>
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

                    <div class="form-group col-md-3">
                        <label for="vacationDate">Fecha Vacaciones</label>
                        <input type="date" class="form-control" id="vacationDate" name="vacationDate" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="vacationDays">Días</label>
                        <input type="tex" class="form-control numberMask active-onchange-vacation" id="vacationDays" name="vacationDays" placeholder="Días" min="1" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="vacationFortnight">Quincena</label>
                        <select class="form-control selectpicker" data-size="5" id="vacationFortnight" name="vacationFortnight" required>
                            <?= Util::getSelectFortnightOptions() ?>
                        </select>
                    </div>

                </div>

                <div class="form-row">

                    <input type="text" class="d-none" id="card" name="card" required readonly>

                    <div class="form-group col-md-4">
                        <label for="completeName">Nombre Completo</label>
                        <input type="text" class="form-control" id="completeName" name="completeName" placeholder="Nombre del Empleado" required readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="admissionDate">Fecha Ingreso</label>
                        <input type="date" class="form-control" id="admissionDate" name="admissionDate" placeholder="Fecha de Ingreso" required readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="position">Puesto</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="Puesto" required readonly>
                    </div>                    

                </div>

                <h4>Salario Base para el Cálculo</h4>

                <?php
                for ($i = 0; $i < 6; $i++) {
                    ?>
                    <h6 class="label-hide">Salario #<?= $i + 1 ?></h6>

                    <div class="form-row">

                        <div class="form-group col-md-2">
                            <label <?= $i == 0 ? '' : 'class="label-hide"'; ?>>Quincena</label>
                            <select class="form-control selectpicker active-onchange-vacation" data-size="5" name="fortnight[]" required>
                                <?= Util::getSelectFortnightOptions(Util::restToCurrentFortnight(6 - $i, $year)) ?>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label <?= $i == 0 ? '' : 'class="label-hide"'; ?>>Año</label>
                            <select class="form-control selectpicker active-onchange-vacation" data-size="5" name="year[]" required>
                                <?= Util::getSelectYearOptions($year) ?>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label <?= $i == 0 ? '' : 'class="label-hide"'; ?>>Días</label>
                            <input type="text" class="form-control numberMask active-onchange-vacation" name="days[]" min="1" value="15" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label <?= $i == 0 ? '' : 'class="label-hide"'; ?>>Devengado</label>
                            <input type="text" class="form-control moneyMask" id="accruing<?= $i ?>" name="accruing[]" readonly>
                        </div>

                    </div>
                    <?php
                }
                ?>

                <div class="form-row justify-content-end">

                    <div class="form-group col-md-4">
                        <label for="avgSalary"><strong>Sala. Prom. Diario</strong></label>
                        <input type="text" class="form-control moneyMask" id="avgSalary" name="avgSalary" readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="daysTotal"><strong>Total Días</strong></label>
                        <input type="text" class="form-control numberMask" id="daysTotal" name="daysTotal" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="salaryTotal"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control moneyMask" id="salaryTotal" name="salaryTotal" readonly>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="accruedVacation"><strong>Devengado Vacac.</strong></label>
                        <input type="text" class="form-control moneyMask" id="accruedVacation" name="accruedVacation" readonly>
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
                            <input type="text" class="form-control moneyMask deduction-input active-onchange-vacation" id="deduction-<?= $value['id'] ?>" name="deductionsMounts[]" required disabled>
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

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="net"><strong>Total Vacac. Neto a Pagar</strong></label>
                        <input type="text" class="form-control moneyMask" id="net" name="net" readonly>
                    </div>

                </div>

                <div class="alert alert-info" role="alert">
                    <i class="fa fa-spinner fa-spin"></i> Calculando...
                </div>
                <script>$('.alert').hide();</script>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="dowloadVacationVaucher();">Descargar Boleta</button>
            </form>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
