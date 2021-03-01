<?php
$vars["viewName"] = 'payroll';
include_once 'presentation/public/header.php';
?>

<script src="/presentation/public/js/payroll.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Insertar Pago Quincenal</h2>
        </div>

        <div class="card-body">

            <a href="/payroll"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <h4>Datos Generales</h4>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="idEmployee">Identificación del Empleado</label>
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
                        <label for="fortnight">Quincena</label>
                        <select class="form-control selectpicker" data-size="5" id="fortnight" name="fortnight" required>
                            <?= Util::getSelectFortnightOptions() ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="year">Año</label>
                        <select class="form-control selectpicker" id="year" name="year" data-size="5" required>
                            <?= Util::getSelectYearOptions() ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="location">Localidad</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Localidad" readonly required>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="position">Puesto</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="Puesto" readonly required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="type">Tipo</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="Tipo" readonly required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="salary">Salario</label>
                        <input type="text" class="form-control moneyMask" id="salary" name="salary" placeholder="Salario" readonly required>
                    </div>
                </div>

                <h4>Ingresos Corrientes</h4>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="workingDays">Días Laborados</label>
                        <input type="text" class="form-control numberMask" id="workingDays" name="workingDays" disabled required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="ordinaryTimeHours">Horas Ordinarias</label>
                        <input type="text" class="form-control numberMask" id="ordinaryTimeHours" name="ordinaryTimeHours" disabled required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="extraTimeHours">Horas Extra</label>
                        <input type="text" class="form-control numberMask" id="extraTimeHours" name="extraTimeHours">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="doubleTimeHours">Horas Doble</label>
                        <input type="text" class="form-control numberMask" id="doubleTimeHours" name="doubleTimeHours">
                    </div>
                </div>
                
                <h4>Ingresos Especiales</h4>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="vacationsDays">Días Vacaciones</label>
                        <input type="text" class="form-control numberMask" id="vacationsDays" name="vacationsDays">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="vacationAmount">Monto Vacaciones</label>
                        <input type="text" class="form-control moneyMask" id="vacationAmount" name="vacationAmount">
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="maternityDays">Días Maternidad</label>
                        <input type="text" class="form-control numberMask" id="INSDamaternityDaysys" name="maternityDays">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="maternityAmount">Monto Maternidad</label>
                        <input type="text" class="form-control moneyMask" id="maternityAmount" name="maternityAmount">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="surcharges">Recargos</label>
                        <input type="text" class="form-control moneyMask" id="surcharges" name="surcharges">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="salaryBonus">Bono Salarial</label>
                        <input type="text" class="form-control moneyMask" id="salaryBonus" name="salaryBonus">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="incentives">Incentivos</label>
                        <input type="text" class="form-control moneyMask" id="incentives" name="incentives">
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
                    
                    <?php
                    foreach ($vars['deductions'] as $value) {
                        ?>
                        <div id="deduction-form-group-<?= $value['id'] ?>" class="form-group col-md-3 deductions">
                            <label for="deduction-<?= $value['id'] ?>"><?= $value['name'] ?></label>
                            <input type="text" class="form-control moneyMask deduction-input" id="deduction-<?= $value['id'] ?>" name="deductionsMounts[]" disabled>
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
                        <input type="text" class="form-control numberMask" id="ccssDays" name="ccssDays">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="ccssAmount">CCSS Monto</label>
                        <input type="text" class="form-control moneyMask" id="ccssAmount" name="ccssAmount">
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="insDays">INS Días</label>
                        <input type="text" class="form-control numberMask" id="insDays" name="insDays">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="insAmount">INS Monto</label>
                        <input type="text" class="form-control moneyMask" id="insAmount" name="insAmount">
                    </div>
                </div>

                <div class="form-group">
                    <label for="observations">Observaciones</label>
                    <textarea class="form-control" id="observations" name="observations" placeholder="Ingrese lo que se le solicita"" maxlength="500"></textarea>
                </div>

                <button id="submit-button" type="button" class="btn btn-primary" onclick="insert();">Insertar</button>
            </form>

            <hr>

            <a href="/payroll"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
