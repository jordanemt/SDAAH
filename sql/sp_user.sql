CREATE PROCEDURE `sp_get_user`(
	id INT
)
BEGIN
	SELECT `id` AS id, `card`, `firstLastName`, `secondLastName`, `name`, `email`, `role` FROM `user` WHERE `user`.`id` = id;
END//

CREATE PROCEDURE `sp_get_all_user`()
BEGIN
	SELECT `id`, `card`, `firstLastName`, `secondLastName`, `name`, `email`, `role` FROM `user` WHERE `user`.`isDeleted` = 0;
END//

CREATE PROCEDURE sp_insert_user(
	card VARCHAR(9),
    pass VARCHAR(32),
    firstLastName VARCHAR(25),
    secondLastName VARCHAR(25),
    name VARCHAR(50),
    email VARCHAR(100),
    role INT
)
BEGIN
	INSERT INTO `user` (
        `card`, 
        `pass`, 
        `firstLastName`, 
        `secondLastName`, 
        `name`, 
        `email`, 
        `role`
        ) VALUES (
            card, 
            pass, 
            firstLastName, 
            secondLastName, 
            name, 
            email, 
            role);
END//

CREATE PROCEDURE `sp_update_user`(
	id INT,
    card VARCHAR(9),
    firstLastName VARCHAR(25),
    secondLastName VARCHAR(25),
    name VARCHAR(50),
    email VARCHAR(100),
    role INT
)
BEGIN
	UPDATE `user`
    SET `card` = card,
        `firstLastName` = firstLastName,
    	`secondLastName` = secondLastName,
        `name` = name,
        `email` = email,
        `role` = role
    WHERE `user`.`id` = id;
END//

CREATE PROCEDURE `sp_remove_user`(
	id INT
)
BEGIN
	UPDATE `user`
    SET `isDeleted` = 1
    WHERE `user`.`id` = id;
END//

CREATE PROCEDURE `sp_update_pass_user`(
	id INT,
    pass VARCHAR(32)
)
BEGIN
	UPDATE `user`
    SET `pass` = pass
    WHERE `user`.`id` = id;
END//

CREATE PROCEDURE `sp_duplicate_card_user`(
	card VARCHAR(9)
)
BEGIN
    SELECT* FROM `user` WHERE `user`.`card` = card  AND `user`.`isDeleted` = 0;
END//