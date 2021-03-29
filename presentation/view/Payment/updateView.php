<?php
$vars["viewName"] = 'payroll';
include_once 'presentation/public/header.php';
?>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Actualizar Pago</h2>
        </div>

        <div class="card-body">

            <a href="?controller=payroll"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <h4>Datos Generales</h4>
                
                <input type="text" class="d-none" name="id" value="<?= $vars['data']['id'] ?>" readonly>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="idEmployee">Identificación del Empleado</label>
                        <select class="form-control selectpicker" data-size="5" id="idEmployee" name="idEmployee" onchange="chargeEmployeeDataOnPayroll();" required>
                            <option selected disabled>Seleccione una opción</option>
                            <?php
                            foreach ($vars['employees'] as $value) {
                                ?>
                                <option <?= ($vars['data']['employee']['id'] == $value['id']) ? 'selected' : '' ?> value="<?= $value['id'] ?>">
                                        <?= $value['card'] . ' ' . $value['name'] . ' ' . $value['firstLastName'] . ' ' . $value['secondLastName'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="loading-div"></div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="fortnight">Quincena</label>
                        <select class="form-control selectpicker" data-size="5" id="fortnight" name="fortnight" required>
                            <?= Util::getSelectFortnightOptions($vars['data']['fortnight']) ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="year">Año</label>
                        <select class="form-control selectpicker" id="year" name="year" data-size="5" name="fortnight" required>
                            <?= Util::getSelectYearOptions($vars['data']['year']) ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="location">Localidad</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Localidad" value="<?= $vars['data']['employee']['location'] ?>" readonly required>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="position">Puesto</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="Puesto" value="<?= $vars['data']['employee']['position']['name'] ?>" readonly required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="type">Tipo</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="Tipo" value="<?= $vars['data']['employee']['position']['type'] ?>" readonly required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="salary">Salario</label>
                        <input type="text" class="form-control moneyMask" id="salary" name="salary" placeholder="Salario" value="<?= $vars['data']['employee']['position']['salary'] ?>" readonly required>
                    </div>
                </div>

                <h4>Ingresos Corrientes</h4>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="workingDays">Días Laborados</label>
                        <input type="text" class="form-control numberMask" id="workingDays" name="workingDays" value="<?= $vars['data']['workingDays'] ?>"
                                    <?= ($vars['data']['employee']['position']['type'] == 'Mensual') ? '' : 'disabled' ?> required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="ordinaryTimeHours">Horas Ordinarias</label>
                        <input type="text" class="form-control numberMask" id="ordinaryTimeHours" name="ordinaryTimeHours" value="<?= $vars['data']['ordinaryTimeHours'] ?>"
                                    <?= ($vars['data']['employee']['position']['type'] == 'Diario') ? '' : 'disabled' ?> required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="extraTimeHours">Horas Extra</label>
                        <input type="text" class="form-control numberMask" id="extraTimeHours" name="extraTimeHours" value="<?= $vars['data']['extraTimeHours'] ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="doubleTimeHours">Horas Doble</label>
                        <input type="text" class="form-control numberMask" id="doubleTimeHours" name="doubleTimeHours" value="<?= $vars['data']['doubleTimeHours'] ?>">
                    </div>
                </div>
                
                <h4>Ingresos Especiales</h4>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="vacationsDays">Días Vacaciones</label>
                        <input type="text" class="form-control numberMask" id="vacationsDays" name="vacationsDays" value="<?= $vars['data']['vacationsDays'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="vacationAmount">Monto Vacaciones</label>
                        <input type="text" class="form-control moneyMask" id="vacationAmount" name="vacationAmount" value="<?= $vars['data']['vacationAmount'] ?>">
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="maternityDays">Días Maternidad</label>
                        <input type="text" class="form-control numberMask" id="INSDamaternityDaysys" name="maternityDays" value="<?= $vars['data']['maternityDays'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="maternityAmount">Monto Maternidad</label>
                        <input type="text" class="form-control moneyMask" id="maternityAmount" name="maternityAmount" value="<?= $vars['data']['maternityAmount'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="surcharges">Recargos</label>
                        <input type="text" class="form-control moneyMask" id="surcharges" name="surcharges" value="<?= $vars['data']['surcharges'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="salaryBonus">Bono Salarial</label>
                        <input type="text" class="form-control moneyMask" id="salaryBonus" name="salaryBonus" value="<?= $vars['data']['salaryBonus'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="incentives">Incentivos</label>
                        <input type="text" class="form-control moneyMask" id="incentives" name="incentives" value="<?= $vars['data']['incentives'] ?>">
                    </div>
                </div>
                
                <h4>Detalle de Deducciones</h4>

                <div class="form-row">
                    <div id="deductionsSelector" class="form-group col-md-3">
                        <label for="deductions">Agregar Deducciones</label>
                        <select class="form-control selectpicker" multiple data-size="5" title="Seleccione ninguna o varias" id="deductions" name="deductions[]" onchange="addDeductions();">
                            <?php
                            foreach ($vars['deductions'] as $value) {
                                ?>
                                <option <?= Util::existOnSomeKey($vars['data']['deductions'], $value, 'id') != -1 ? 'selected' : '' ?> 
                                    value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
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
                    
                    <?php
                    foreach ($vars['deductions'] as $value) {
                        ?>
                        <div id="deduction-form-group-<?= $value['id'] ?>" class="form-group col-md-3 deductions">
                            <label for="deduction-<?= $value['id'] ?>"><?= $value['name'] ?></label>
                            <input type="text" class="form-control moneyMask deduction-input" id="deduction-<?= $value['id'] ?>" name="deductionsMounts[]" 
                                   value="
                                       <?php
                                       $key = Util::existOnSomeKey($vars['data']['deductions'], $value, 'id');
                                       if ($key != -1) {
                                           echo $vars['data']['deductions'][$key]['mount'];
                                       } else {
                                           echo '';
                                       }
                                       ?>" disabled>
                        </div>
                        <?php
                    }
                    ?>

                    <script>$(".deductions").hide();</script>
                </div>

                <h4>Incapacidades</h4>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="ccssDays">CCSS Días</label>
                        <input type="text" class="form-control numberMask" id="ccssDays" name="ccssDays" value="<?= $vars['data']['ccssDays'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="ccssAmount">CCSS Monto</label>
                        <input type="text" class="form-control moneyMask" id="ccssAmount" name="ccssAmount" value="<?= $vars['data']['ccssAmount'] ?>">
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="insDays">INS Días</label>
                        <input type="text" class="form-control numberMask" id="insDays" name="insDays" value="<?= $vars['data']['insDays'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="insAmount">INS Monto</label>
                        <input type="text" class="form-control moneyMask" id="insAmount" name="insAmount" value="<?= $vars['data']['insAmount'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="observations">Observaciones</label>
                    <textarea class="form-control" id="observations" name="observations" placeholder="Ingrese lo que se le solicita"" maxlength="500"><?= $vars['data']['observations'] ?></textarea>
                </div>
                
                <div class="alert alert-warning" role="alert">
                    El pago se actualizará con los parámetros actuales
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="updatePayment();">Actualizar</button>
            </form>
            
            <script>
                addDeductions();
            </script>

            <hr>

            <a href="?controller=payroll"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
