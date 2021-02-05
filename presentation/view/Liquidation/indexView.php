<?php
$vars["viewName"] = 'liquidation';
include_once 'presentation/public/header.php';

if (!isset($_SESSION['id'])) {
    header('Location: ?controller=Index');
}
?>

<script src="presentation/public/js/vacation.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Cálculo de Liquidación</h2>
        </div>

        <div class="card-body">

            <hr>

            <form id="form">
                <h4>Datos Personales</h4>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="idEmployee">Identificación</label>
                        <select class="form-control" id="idEmployee" name="idEmployee" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="1">000000000</option>
                            <option value="2">000000000</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="departureDate">Fecha de Salida</label>
                        <input type="date" class="form-control" id="departureDate" name="departureDate" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="reason">Motivo</label>
                        <select class="form-control" id="reason" name="reason" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="1">Renuncia Voluntaria</option>
                            <option value="2">Despido con Responsabilidad Patronal</option>
                            <option value="2">Despido sin Responsabilidad Patronal</option>
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
                        <input type="text" class="form-control" id="admissionDate" name="admissionDate" placeholder="Fecha de Ingreso" required disabled>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="record">Récord</label>
                        <input type="text" class="form-control" id="record" name="record" required disabled>
                    </div>                    

                </div>

                <h4>Salario Base para el Cálculo</h4>

                <h6 class="label-hide">Salario #1</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight">Quincena</label>
                        <select class="form-control" id="fortnight1" name="fortnight[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year">Año</label>
                        <input type="number" class="form-control" id="year1" name="year[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days">Días</label>
                        <input type="number" class="form-control" id="days1" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing">Devengado</label>
                        <input type="text" class="form-control" id="accruing1" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #2</h6>

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

                <h6 class="label-hide">Salario #3</h6>

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

                <div class="form-row justify-content-end">

                    <div class="form-group col-md-4">
                        <label for="averageDailyWage"><strong>Sala. Prom. Diario</strong></label>
                        <input type="text" class="form-control" id="averageDailyWage" name="averageDailyWage" required disabled>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="totalVacation"><strong>Total Días</strong></label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="totalSalaries"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control" id="totalSalaries" name="totalSalaries" required disabled>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="accruingVacation"><strong>Devengado Vacac.</strong></label>
                        <input type="text" class="form-control" id="accruingVacation" name="accruingVacation" required disabled>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="pendingVacationDays"><strong>Vacac. Pend.</strong></label>
                        <input type="number" class="form-control" id="pendingVacationDays" name="pendingVacationDays" min="0" value="0" required>
                    </div>

                </div>

                <h4>Detalle de Deducciones</h4>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="CCSSFee">Cuota CCSS</label>
                        <input type="text" class="form-control" id="CCSSFee" name="CCSSFee" required disabled>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="incomeTax">Imp. Sobre la Renta</label>
                        <input type="text" class="form-control" id="incomeTax" name="incomeTax" required disabled>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="advancementOfUnemployment">Adelanto de Cesantía</label>
                        <input type="text" class="form-control" id="advancementOfUnemployment" name="advancementOfUnemployment">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="solidarityAssociationLoan">Préstamo. Asoc. Solidarista</label>
                        <input type="text" class="form-control" id="solidarityAssociationLoan" name="solidarityAssociationLoan">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="solidarityAssociationSavings">Ahorro Asoc. Solidar.</label>
                        <input type="text" class="form-control" id="solidarityAssociationSavings" name="solidarityAssociationSavings">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="salaryAdvance">Anticipo Salarial</label>
                        <input type="text" class="form-control" id="salaryAdvance" name="salaryAdvance">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="extraordinarySavings">Ahorro Extraordinario</label>
                        <input type="text" class="form-control" id="extraordinarySavings" name="extraordinarySavings">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="wageGarnishment">Embargo Salarial</label>
                        <input type="text" class="form-control" id="wageGarnishment" name="wageGarnishment">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="alimony">Pensión Alimenticia</label>
                        <input type="text" class="form-control" id="alimony" name="alimony">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="totalDeductions"><strong>Total Deducciones</strong></label>
                        <input type="text" class="form-control" id="totalDeductions" name="totalDeductions" required disabled>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalNetVacationPayable"><strong>Neto Vacac. Proporcionales</strong></label>
                        <input type="text" class="form-control" id="totalNetVacationPayable" name="totalNetVacationPayable" required disabled>
                    </div>

                </div>

                <h4>Cálculo de Pre-aviso y Cesantía</h4>

                <h6 class="label-hide">Salario #1</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight">Quincena</label>
                        <select class="form-control" id="fortnight1" name="fortnight[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year">Año</label>
                        <input type="number" class="form-control" id="year1" name="year[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days">Días</label>
                        <input type="number" class="form-control" id="days1" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing">Devengado</label>
                        <input type="text" class="form-control" id="accruing1" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #2</h6>

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

                <h6 class="label-hide">Salario #3</h6>

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
                
                <div class="form-row justify-content-end">

                    <div class="form-group col-md-4">
                        <label for="averageDailyWage"><strong>Sala. Prom. Diario</strong></label>
                        <input type="text" class="form-control" id="averageDailyWage" name="averageDailyWage" required disabled>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="totalVacation"><strong>Total Días</strong></label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="totalSalaries"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control" id="totalSalaries" name="totalSalaries" required disabled>
                    </div>

                </div>
                
                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="averageDailyWage">Días Pre-aviso</label>
                        <input type="number" class="form-control" id="averageDailyWage" name="averageDailyWage" min="0" value="0" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalVacation"><strong>Tot. Días Pre-aviso</strong></label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="averageDailyWage">Días Cesantía</label>
                        <input type="number" class="form-control" id="averageDailyWage" name="averageDailyWage" min="0" value="0" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="totalVacation"><strong>Tot. Días Cesantía</strong></label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>

                </div>
                
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="totalVacation"><strong>Total Devengado Pre-aviso y Cesantia</strong></label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>

                </div>
                
                <h4>Cálculo de Aguinaldo</h4>

                <h6 class="label-hide">Salario #1</h6>

                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="fortnight">Quincena</label>
                        <select class="form-control" id="fortnight1" name="fortnight[]" required>
                            <option value="1">Q-1</option>
                            <option value="2">Q-2</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year">Año</label>
                        <input type="number" class="form-control" id="year1" name="year[]" value="2021" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="days">Días</label>
                        <input type="number" class="form-control" id="days1" name="days[]" min="1" value="15" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="accruing">Devengado</label>
                        <input type="text" class="form-control" id="accruing1" name="accruing[]" required disabled>
                    </div>

                </div>

                <h6 class="label-hide">Salario #2</h6>

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

                <h6 class="label-hide">Salario #3</h6>

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
                    
                    <div class="form-group col-md-4">
                        <label for="totalVacation"><strong>Tot. Deven. Aguinaldo</strong></label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="totalVacation"><strong>Total Días</strong></label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="totalSalaries"><strong>Total Salarios</strong></label>
                        <input type="text" class="form-control" id="totalSalaries" name="totalSalaries" required disabled>
                    </div>

                </div>
                
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="totalVacation"><strong>A Pagar Prestaciones Legales</strong></label>
                        <input type="text" class="form-control" id="totalVacation" name="totalVacation" required disabled>
                    </div>

                </div>
                
                <a class="btn btn-info mx-1" href="#" role="button"><i class="fa fa-file"></i> Generar Boleta</a>
            </form>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
