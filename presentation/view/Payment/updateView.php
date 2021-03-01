<?php
$vars["viewName"] = 'payroll';
include_once 'presentation/public/header.php';
require_once 'common/Util.php';
$fortnight = Util::getFortnight();
?>

<script src="/presentation/public/js/payroll.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Actualizar en la Nómina</h2>
        </div>

        <div class="card-body">

            <a href="/payroll"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <h4>Datos Generales</h4>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="idEmployee">Identificación del Empleado</label>
                        <select class="form-control" id="idEmployee" name="idEmployee" onchange="getPositionEmployee();" required>
                            <option selected disabled>Seleccione una opción</option>
                            <?php
                            foreach ($vars['employees'] as $value) {
                                ?>
                                <option value="<?php echo $value['id'] ?>"><?php echo $value['card'] . ' ' . $value['name'] . ' ' . $value['firstLastName'] . ' ' . $value['secondLastName'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="fortnight">Quincena</label>
                        <select class="form-control" id="fortnight" name="fortnight" required>
                            <option disabled>Seleccione una opción</option>
                            <option <?php echo ($fortnight == 1) ? 'selected' : '' ?> value="1">Q-1</option>
                            <option <?php echo ($fortnight == 2) ? 'selected' : '' ?> value="2">Q-2</option>
                            <option <?php echo ($fortnight == 3) ? 'selected' : '' ?> value="3">Q-3</option>
                            <option <?php echo ($fortnight == 4) ? 'selected' : '' ?> value="4">Q-4</option>
                            <option <?php echo ($fortnight == 5) ? 'selected' : '' ?> value="5">Q-5</option>
                            <option <?php echo ($fortnight == 6) ? 'selected' : '' ?> value="6">Q-6</option>
                            <option <?php echo ($fortnight == 7) ? 'selected' : '' ?> value="7">Q-7</option>
                            <option <?php echo ($fortnight == 8) ? 'selected' : '' ?> value="8">Q-8</option>
                            <option <?php echo ($fortnight == 9) ? 'selected' : '' ?> value="9">Q-9</option>
                            <option <?php echo ($fortnight == 10) ? 'selected' : '' ?> value="10">Q-10</option>
                            <option <?php echo ($fortnight == 11) ? 'selected' : '' ?> value="11">Q-11</option>
                            <option <?php echo ($fortnight == 12) ? 'selected' : '' ?> value="12">Q-12</option>
                            <option <?php echo ($fortnight == 13) ? 'selected' : '' ?> value="13">Q-13</option>
                            <option <?php echo ($fortnight == 14) ? 'selected' : '' ?> value="14">Q-14</option>
                            <option <?php echo ($fortnight == 15) ? 'selected' : '' ?> value="15">Q-15</option>
                            <option <?php echo ($fortnight == 16) ? 'selected' : '' ?> value="16">Q-16</option>
                            <option <?php echo ($fortnight == 17) ? 'selected' : '' ?> value="17">Q-17</option>
                            <option <?php echo ($fortnight == 18) ? 'selected' : '' ?> value="18">Q-18</option>
                            <option <?php echo ($fortnight == 19) ? 'selected' : '' ?> value="19">Q-19</option>
                            <option <?php echo ($fortnight == 20) ? 'selected' : '' ?> value="20">Q-20</option>
                            <option <?php echo ($fortnight == 21) ? 'selected' : '' ?> value="21">Q-21</option>
                            <option <?php echo ($fortnight == 22) ? 'selected' : '' ?> value="22">Q-22</option>
                            <option <?php echo ($fortnight == 23) ? 'selected' : '' ?> value="23">Q-23</option>
                            <option <?php echo ($fortnight == 24) ? 'selected' : '' ?> value="24">Q-24</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="year">Año</label>
                        <input type="text" class="form-control numberMask" id="year" name="year" min="1950" max="<?php echo date("Y") + 5; ?>" minlength="4" maxlength="4" value="<?php echo date("Y"); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="location">Localidad</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Localidad" value="<?php echo $vars['data']['location'] ?>" readonly required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="type">Tipo</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="Tipo" value="<?php echo $vars['data']['type'] ?>" readonly required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="salary">Salario</label>
                        <input type="text" class="form-control moneyMask" id="salary" name="salary" placeholder="Salario" value="<?php echo $vars['data']['salary'] ?>" readonly required>
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
                                <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
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
                        <div id="deduction-form-group-<?php echo $value['id'] ?>" class="form-group col-md-3 deductions">
                            <label for="deduction-<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                            <input type="text" class="form-control moneyMask deduction-input" id="deduction-<?php echo $value['id'] ?>" name="deductionsMounts[]" disabled required>
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

                <button id="submit-button" type="button" class="btn btn-primary" onclick="update();">Actualizar</button>
            </form>

            <hr>

            <a href="/payroll"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php
include_once 'presentation/public/footer.php';
