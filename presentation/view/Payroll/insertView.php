<?php

$vars["payroll-view"] = true;
include_once 'presentation/public/header.php';
?>

<script src="presentation/public/js/payroll.js" type="text/javascript"></script>

<div class="container my-4">
    <div class="card">

        <div class="card-header text-center">
            <h2>Insertar en la Nómina</h2>
        </div>

        <div class="card-body">

            <a href="?controller=Payroll"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

            <hr>

            <form id="form">
                <h4>Datos Generales</h4>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="idEmployee">Identificación del Empleado</label>
                        <select class="form-control" id="type" name="idEmployee" onchange="switchVisibilityToShow('#income-container'); showSalaryOptions();" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="Mensual">000000000 Mensual</option>
                            <option value="Diario">000000000 Ordinario</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="fortnight">Quincena</label>
                        <select class="form-control" id="fortnight" name="fortnight" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="1">Q-1</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="year">Año</label>
                        <select class="form-control" id="year" name="year" required>
                            <option selected disabled>Seleccione una opción</option>
                            <option value="1">2020</option>
                        </select>
                    </div>
                </div>

                <div id="income-container"> <script>switchVisibilityToHide('#income-container');</script>
                    <h4>Ingresos Corrientes</h4>

                    <div id="salary-container" class="form-group"> <script>switchVisibilityToHide('#salary-container');</script>
                        <label for="workingDays">Días Laborados</label>
                        <input type="text" class="form-control" id="workingDays" name="workingDays" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div id="time-container" class="form-row"> <script>switchVisibilityToHide('#time-container');</script>
                        <div class="form-group col-md-4">
                            <label for="ordinaryTimeHours">Horas Ordinarias</label>
                            <input type="text" class="form-control" id="ordinaryTimeHours" name="ordinaryTimeHours" placeholder="Ingrese lo que se le solicita" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="extraTimeHours">Horas Extra</label>
                            <input type="text" class="form-control" id="extraTimeHours" name="extraTimeHours" placeholder="Ingrese lo que se le solicita" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="doubleTimeHours">Horas Doble</label>
                            <input type="text" class="form-control" id="doubleTimeHours" name="doubleTimeHours" placeholder="Ingrese lo que se le solicita" required>
                        </div>
                    </div>
                </div>

                <h4>Vacaciones</h4>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="vacationsDays">Días</label>
                        <input type="text" class="form-control" id="vacationsDays" name="vacationsDays" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="vacationAmount">Monto</label>
                        <input type="text" class="form-control" id="vacationAmount" name="vacationAmount" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>
                
                <h4>Incapacidades</h4>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="CCSSDays">CCSS Días</label>
                        <input type="text" class="form-control" id="CCSSDays" name="CCSSDays" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="CCSSAmount">CCSS Monto</label>
                        <input type="text" class="form-control" id="CCSSAmount" name="CCSSAmount" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="INSDays">INS Días</label>
                        <input type="text" class="form-control" id="INSDays" name="INSDays" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="INSAmount">INS Monto</label>
                        <input type="text" class="form-control" id="INSAmount" name="INSAmount" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>
                
                <h4>Ingresos Especiales</h4>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="salaryBonus">Bono Salarial</label>
                        <input type="text" class="form-control" id="salaryBonus" name="salaryBonus" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="incentives">Incentivos</label>
                        <input type="text" class="form-control" id="incentives" name="incentives" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="surcharges">Recargos</label>
                        <input type="text" class="form-control" id="surcharges" name="surcharges" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="maternityDays">Días Maternidad</label>
                        <input type="text" class="form-control" id="INSDamaternityDaysys" name="maternityDays" placeholder="Ingrese lo que se le solicita" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="maternityAmount">Monto Maternidad</label>
                        <input type="text" class="form-control" id="maternityAmount" name="maternityAmount" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>
                
                <h4>Detalle de Deducciones</h4>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="vehicleLoan">Préstamo Vehículo</label>
                        <input type="text" class="form-control" id="vehicleLoan" name="vehicleLoan" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="solidarityLoanAssociation">Préstamo Asoc. Solidarista</label>
                        <input type="text" class="form-control" id="solidarityLoanAssociation" name="solidarityLoanAssociation" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="advances">Anticipos</label>
                        <input type="text" class="form-control" id="advances" name="advances" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="extraSavings">Ahorros Extra</label>
                        <input type="text" class="form-control" id="extraSavings" name="extraSavings" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="liens">Embargos</label>
                        <input type="text" class="form-control" id="liens" name="liens" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="alimony">Pensión Alimenticia</label>
                        <input type="text" class="form-control" id="alimony" name="alimony" placeholder="Ingrese lo que se le solicita" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="observations">Observaciones</label>
                    <textarea class="form-control" id="observations" name="observations" placeholder="Ingrese lo que se le solicita"" maxlength="500" required></textarea>
                </div>
                
                <button id="submit-button" type="button" class="btn btn-primary" onclick="insert();">Insertar</button>
            </form>

            <hr>

            <a href="?controller=Payroll"><i class="fa fa-angle-double-left"></i> Volver a la Lista</a>

        </div>

    </div>
</div>

<?php

include_once 'presentation/public/footer.php';
