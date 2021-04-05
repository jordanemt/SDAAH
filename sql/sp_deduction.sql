CREATE PROCEDURE `sp_get_deduction`(
    id INT
)
BEGIN
	SELECT* FROM `deduction` WHERE `deduction`.`id` = id AND `deduction`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_deduction`()
BEGIN
	SELECT* FROM `deduction` WHERE `deduction`.`isDeleted` = 0 ORDER BY `name`;
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

CREATE PROCEDURE `sp_is_associated_with_payment_deduction`(
	id INT
)
BEGIN
    SELECT `idDeduction` FROM `payment_deduction` WHERE `payment_deduction`.`idDeduction` = id;
END//

CREATE PROCEDURE `sp_get_all_by_idPayment_payment_deduction`(
	idPayment INT
)
BEGIN
	SELECT d.`id`, d.`name`, pd.`mount` FROM `deduction` d 
        JOIN `payment_deduction` pd 
            ON d.`id` = pd.`idDeduction`
    WHERE pd.`idPayment` = idPayment AND d.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_insert_payment_deduction`(
    idPayment INT,
    idDeduction INT,
    mount DECIMAL(11,2)
)
BEGIN
	INSERT INTO `payment_deduction` (
        `idPayment`,
        `idDeduction`,
        `mount`
        ) VALUES (
            idPayment,
            idDeduction,
            mount);
END//

CREATE PROCEDURE `sp_remove_by_idPayment_payment_deduction`(
	idPayment INT
)
BEGIN
	DELETE FROM `payment_deduction`
    WHERE `payment_deduction`.`idPayment` = idPayment;
END//
