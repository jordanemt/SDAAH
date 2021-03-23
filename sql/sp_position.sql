CREATE PROCEDURE `sp_get_position`(
	id INT
)
BEGIN
	SELECT* FROM `position` WHERE `position`.`id` = id AND `position`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_by_type_position`(
	type VARCHAR(7)
)
BEGIN
    SELECT* FROM `position` WHERE `position`.`type` = type AND `position`.`isDeleted` = 0 ORDER BY `name`;
END//

CREATE PROCEDURE `sp_get_all_position`()
BEGIN
	SELECT* FROM `position` WHERE `position`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_insert_position`(
    cod VARCHAR(4),
    name VARCHAR(25),
    type VARCHAR(7),
    salary DECIMAL(11,2)
)
BEGIN
	INSERT INTO `position` (
        `cod`,
        `name`,
        `type`,
        `salary`
        ) VALUES (
            cod,
            name,
            type,
            salary);
END//

CREATE PROCEDURE `sp_update_position`(
    id INT,
	cod VARCHAR(4),
    name VARCHAR(25),
    type VARCHAR(7),
    salary DECIMAL(11,2)
)
BEGIN
	UPDATE position
    SET `cod` = cod,
        `name` = name,
        `type` = type,
        `salary` = salary
    WHERE `position`.`id` = id;
END//

CREATE PROCEDURE `sp_remove_position`(
	id INT
)
BEGIN
	UPDATE `position`
    SET `isDeleted` = 1
    WHERE `position`.`id` = id;
END//

CREATE PROCEDURE `sp_duplicate_cod_position`(
	cod VARCHAR(9)
)
BEGIN
    SELECT* FROM `position` WHERE `position`.`cod` = cod AND `position`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_is_associated_with_employee_position`(
	id INT
)
BEGIN
    SELECT* FROM `employee` WHERE `employee`.`idPosition` = id AND `employee`.`isDeleted` = 0;
END//
