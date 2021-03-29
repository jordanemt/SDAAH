CREATE PROCEDURE `sp_get_param`(
    id INT
)
BEGIN
	SELECT* FROM `param` WHERE `param`.`id` = id AND `param`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_param`()
BEGIN
	SELECT* FROM `param` WHERE `param`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_update_param`(
    id INT,
    percentage DECIMAL(11,2)
)
BEGIN
	UPDATE `param`
    SET `percentage` = percentage
    WHERE `param`.`id` = id;
END//