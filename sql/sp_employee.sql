CREATE PROCEDURE `sp_get_employee`(
	id INT
)
BEGIN
	SELECT* FROM `employee` WHERE `employee`.`id` = id AND `employee`.`isDeleted` = 0  ORDER BY `location`;
END//

CREATE PROCEDURE `sp_get_all_employee`()
BEGIN
	SELECT* FROM `employee` WHERE `employee`.`isDeleted` = 0 ORDER BY `location` ASC, `firstLastName` ASC;
END//

CREATE PROCEDURE `sp_get_all_not_liquidated_employee`()
BEGIN
	SELECT* FROM `employee` WHERE `employee`.`isDeleted` = 0 AND `employee`.`isLiquidated` = 0 ORDER BY `location` ASC, `firstLastName` ASC;
END//

CREATE PROCEDURE `sp_get_employee_days_spent_on_vacation_by_id`(
    id INT
)
BEGIN
    SELECT e.`card`, 
	CONCAT(e.`firstLastName`, ' ', e.`secondLastName`, ' ', e.`name`) AS completeName, 
    ps.`name`, 
    ps.`type`,
    e.`location`, 
    e.`admissionDate`,
    SUM(p.`vacationsDays`) AS vacationsDays
    FROM `employee` e 
        JOIN `position` ps ON e.`idPosition` = ps.`id` 
        JOIN `payment` p ON p.`idEmployee` = e.`id`
    WHERE e.`id` = id AND e.`isDeleted` = 0 AND ps.`isDeleted` = 0 AND (p.`isDeleted` IS NULL || p.`isDeleted` = 0);
END//

CREATE PROCEDURE `sp_insert_employee`(
    card VARCHAR(9),
    firstLastName VARCHAR(25),
    secondLastName VARCHAR(25),
    name VARCHAR(50),
    gender VARCHAR(9),
    birthdate DATE,
    idPosition INT,
    location VARCHAR(14),
    admissionDate DATE,
    bank VARCHAR(30),
    bankAccount VARCHAR(30),
    email VARCHAR(100),
    cssIns VARCHAR(4),
    isAffiliated SMALLINT,
    observations VARCHAR(500)
)
BEGIN
	INSERT INTO `employee` (
        `card`,
        `firstLastName`,
        `secondLastName`,
        `name`,
        `gender`,
        `birthdate`,
        `idPosition`,
        `location`,
        `admissionDate`,
        `bank`,
        `bankAccount`,
        `email`,
        `cssIns`,
        `isAffiliated`,
        `observations`
        ) VALUES (
            card,
            firstLastName,
            secondLastName,
            name,
            gender,
            birthdate,
            idPosition,
            location,
            admissionDate,
            bank,
            bankAccount,
            email,
            cssIns,
            isAffiliated,
            observations);
END//

CREATE PROCEDURE `sp_update_employee`(
    id INT,
    firstLastName VARCHAR(25),
    secondLastName VARCHAR(25),
    name VARCHAR(50),
    gender VARCHAR(9),
    birthdate DATE,
    idPosition INT,
    location VARCHAR(14),
    admissionDate DATE,
    bank VARCHAR(30),
    bankAccount VARCHAR(30),
    email VARCHAR(100),
    cssIns VARCHAR(4),
    isAffiliated SMALLINT,
    isLiquidated SMALLINT,
    observations VARCHAR(500)
)
BEGIN
	UPDATE `employee`
    SET `firstLastName` = firstLastName,
        `secondLastName` = secondLastName,
        `name` = name,
        `gender` = gender,
        `birthdate` = birthdate,
        `idPosition` = idPosition,
        `location` = location,
        `admissionDate` = admissionDate,
        `bank` = bank,
        `bankAccount` = bankAccount,
        `email` = email,
        `cssIns` = cssIns,
        `isAffiliated` = isAffiliated,
        `isLiquidated` = isLiquidated,
        `observations` = observations
    WHERE `employee`.`id` = id;
END//

CREATE PROCEDURE `sp_remove_employee`(
	id INT
)
BEGIN
	UPDATE `employee`
    SET `isDeleted` = 1
    WHERE `employee`.`id` = id;
END//

CREATE PROCEDURE `sp_duplicate_card_employee`(
	card VARCHAR(9)
)
BEGIN
    SELECT* FROM `employee` WHERE `employee`.`card` = card AND 
        `employee`.`isLiquidated` = 0 AND `employee`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_is_associated_with_payment_employee`(
	id int
)
BEGIN
    SELECT* FROM `payment` WHERE `payment`.`idEmployee` = id AND `payment`.`isDeleted` = 0;
END//
