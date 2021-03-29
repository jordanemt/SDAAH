CREATE PROCEDURE `sp_get_employee`(
	id INT
)
BEGIN
	SELECT* FROM `employee` WHERE `employee`.`id` = id AND `employee`.`isDeleted` = 0  ORDER BY `location`;
END//

CREATE PROCEDURE `sp_get_employee_with_deleted`(
	id INT
)
BEGIN
	SELECT* FROM `employee` WHERE `employee`.`id` = id;
END//

CREATE PROCEDURE `sp_get_all_employee`()
BEGIN
	SELECT* FROM `employee` WHERE `employee`.`isDeleted` = 0;
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
    WHERE e.`id` = id AND e.`isDeleted` = 0 AND p.`isDeleted` = 0 AND ps.`isDeleted` = 0;
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
    bankAccount VARCHAR(15),
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
    bankAccount VARCHAR(15),
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
    SELECT* FROM `employee` WHERE `employee`.`card` = card AND `employee`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_alimonyOnBonus_by_idEmployee_and_year`(
	idEmployee INT,
    year INT
)
BEGIN
	SELECT* FROM `alimonyOnBonus` WHERE `alimonyOnBonus`.`idEmployee` = idEmployee AND `alimonyOnBonus`.`year` = year;
END//

CREATE PROCEDURE `sp_insert_alimonyOnBonus`(
	idEmployee INT,
    year INT,
    mount DECIMAL(11,2)
)
BEGIN
	INSERT INTO `alimonyOnBonus` (
        `idEmployee`,
        `year`,
        `mount`
        ) VALUES (
            idEmployee,
            year,
            mount);
END//

CREATE PROCEDURE `sp_update_alimonyOnBonus`(
    id INT,
    mount DECIMAL(11,2)
)
BEGIN
	UPDATE `alimonyOnBonus`
    SET `mount` = mount
    WHERE `alimonyOnBonus`.`id` = id;
END//