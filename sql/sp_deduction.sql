CREATE PROCEDURE `sp_get_all_deduction`()
BEGIN
	SELECT* FROM `deduction` WHERE `deduction`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_insert_deduction`(
    name VARCHAR(100)
)
BEGIN
	INSERT INTO `deduction` (`name`) VALUES (name);
END//

CREATE PROCEDURE `sp_remove_deduction`(
	id INT
)
BEGIN
	UPDATE `deduction`
    SET `isDeleted` = 1
    WHERE `deduction`.`id` = id;
END//

CREATE PROCEDURE `sp_is_associated_with_payroll_deduction`(
	id INT
)
BEGIN
    SELECT `idDeduction` FROM `payroll_deduction` WHERE `payroll_deduction`.`idDeduction` = id;
END//

CREATE PROCEDURE `sp_get_all_by_idPayroll_payroll_deduction`(
	idPayroll INT
)
BEGIN
	SELECT d.`id`, d.`name`, pd.`mount` FROM `deduction` d 
        JOIN `payroll_deduction` pd 
            ON d.`id` = pd.`idDeduction`
    WHERE pd.`idPayroll` = idPayroll AND d.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_insert_payroll_deduction`(
    idPayroll INT,
    idDeduction INT,
    mount DECIMAL(11,2)
)
BEGIN
	INSERT INTO `payroll_deduction` (
        `idPayroll`,
        `idDeduction`,
        `mount`
        ) VALUES (
            idPayroll,
            idDeduction,
            mount);
END//

CREATE PROCEDURE `sp_remove_by_idPayroll_payroll_deduction`(
	idPayroll INT
)
BEGIN
	DELETE FROM `payroll_deduction`
    WHERE `payroll_deduction`.`idPayroll` = idPayroll;
END//

CALL `sp_insert_deduction` ('Ahorro Asociación Solidarista');
CALL `sp_insert_deduction` ('Adelanto de Cesantía');
CALL `sp_insert_deduction` ('Préstamo Asociación Solidarista');
CALL `sp_insert_deduction` ('Anticipo Salarial');
CALL `sp_insert_deduction` ('Ahorro Extraordinario');
CALL `sp_insert_deduction` ('Embargo Salarial');
CALL `sp_insert_deduction` ('Pensión Alimenticia');
CALL `sp_insert_deduction` ('Préstamo Vehículo');