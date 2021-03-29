CREATE PROCEDURE `sp_get_incometax`(
    id INT
)
BEGIN
	SELECT* FROM `incometax` WHERE `incometax`.`id` = id AND `incometax`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_incometax`()
BEGIN
	SELECT* FROM `incometax` WHERE `incometax`.`isDeleted` = 0 ORDER BY `percentage`;
END//

CREATE PROCEDURE `sp_insert_incometax`(
    section DECIMAL(11,2),
    percentage DECIMAL(11,2)
)
BEGIN
	INSERT INTO `incometax` (`section`, `percentage`) VALUES (section, percentage);
END//

CREATE PROCEDURE `sp_remove_incometax`(
	id INT
)
BEGIN
	UPDATE `incometax`
    SET `isDeleted` = 1
    WHERE `incometax`.`id` = id;
END//