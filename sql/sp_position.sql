CREATE PROCEDURE sp_get_position(
	id INT
)
BEGIN
	SELECT * FROM position WHERE position.id = id AND position.isDeleted = 0;
END//

CREATE PROCEDURE sp_get_all_position()
BEGIN
	SELECT* FROM position WHERE position.isDeleted = 0;
END//

CREATE PROCEDURE sp_insert_position(
    cod INT,
    name VARCHAR(25),
    type INT,
    salary DECIMAL,
    ordinaryTime DECIMAL,
    extraTime DECIMAL,
    doubleTime DECIMAL
)
BEGIN
	INSERT INTO position (
        cod,
        name,
        type,
        salary,
        ordinaryTime,
        extraTime,
        doubleTime
        ) VALUES (
            cod,
            name,
            type,
            salary,
            ordinaryTime,
            extraTime,
            doubleTime);
END//

CREATE PROCEDURE sp_update_position(
    id INT,
	cod INT,
    name VARCHAR(25),
    type INT,
    salary DECIMAL,
    ordinaryTime DECIMAL,
    extraTime DECIMAL,
    doubleTime DECIMAL
)
BEGIN
	UPDATE position
    SET cod = cod,
        name = name,
        type = type,
        salary = salary,
        ordinaryTime = ordinaryTime,
        extraTime = extraTime,
        doubleTime = doubleTime
    WHERE position.id = id;
END//

CREATE PROCEDURE sp_remove_position(
	id INT
)
BEGIN
	UPDATE position
    SET isDeleted = 1
    WHERE position.id = id;
END//

CREATE PROCEDURE sp_duplicate_cod_position(
	cod VARCHAR(9)
)
BEGIN
    SELECT* FROM position WHERE position.cod = cod AND position.isDeleted = 0;
END//