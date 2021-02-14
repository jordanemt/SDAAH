CREATE PROCEDURE `sp_get_employee`(
	id INT
)
BEGIN
	SELECT* FROM `employee` WHERE `employee`.`id` = id AND `employee`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_employee`()
BEGIN
	SELECT* FROM `employee` WHERE `employee`.`isDeleted` = 0;
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
    isAffiliated SMALLINT
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
        `isAffiliated`
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
            isAffiliated);
END//

CREATE PROCEDURE `sp_update_employee`(
    id INT,
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
    isLiquidated SMALLINT,
    observations VARCHAR(500)
)
BEGIN
	UPDATE `employee`
    SET `card` = card,
        `firstLastName` = firstLastName,
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

CREATE PROCEDURE `sp_get_position_employee`(
	id INT
)
BEGIN
    SELECT e.location, p.type, p.salary FROM `employee` e
    JOIN `position` p ON e.`idPosition` = p.`id`
    WHERE e.`id` = id AND e.`isDeleted` = 0;
END//