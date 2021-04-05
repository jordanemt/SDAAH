CREATE PROCEDURE `sp_get_alimonybonus_by_idEmployee_and_year`(
	idEmployee INT,
    year INT
)
BEGIN
	SELECT* FROM `alimonybonus` WHERE `alimonybonus`.`idEmployee` = idEmployee AND `alimonybonus`.`year` = year;
END//

CREATE PROCEDURE `sp_insert_alimonybonus`(
	idEmployee INT,
    year INT,
    mount DECIMAL(11,2)
)
BEGIN
	INSERT INTO `alimonybonus` (
        `idEmployee`,
        `year`,
        `mount`
        ) VALUES (
            idEmployee,
            year,
            mount);
END//

CREATE PROCEDURE `sp_update_alimonybonus`(
    id INT,
    mount DECIMAL(11,2)
)
BEGIN
	UPDATE `alimonybonus`
    SET `mount` = mount
    WHERE `alimonybonus`.`id` = id;
END//