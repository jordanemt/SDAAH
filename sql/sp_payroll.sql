CREATE PROCEDURE `sp_get_payroll`(
	id INT
)
BEGIN
	SELECT* FROM `payroll` WHERE `payroll`.`id` = id AND `payroll`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_by_idEmployee_and_fortnight_and_year_payroll`(
    idEmployee INT,
    fortnight INT,
	year INT
)
BEGIN
	SELECT* FROM `payroll` WHERE `payroll`.`idEmployee` = idEmployee AND 
        `payroll`.`fortnight` = fortnight AND
        `payroll`.`year` = year AND 
        `payroll`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_by_filter_biweekly_payroll`(
    fortnight INT,
	year INT,
    location VARCHAR(25)
)
BEGIN
	SELECT* FROM `payroll` WHERE  
        `payroll`.`location` REGEXP location AND
        `payroll`.`fortnight` = fortnight AND
        `payroll`.`year` = year AND 
        `payroll`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_by_filter_monthly_payroll`(
    month INT,
	year INT
)
BEGIN
	SELECT* FROM `payroll` WHERE  
        `payroll`.`fortnight` IN ((month * 2), (month * 2 - 1)) AND
        `payroll`.`year` = year AND 
        `payroll`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_payroll`()
BEGIN
	SELECT* FROM `payroll` WHERE `payroll`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_on_bonus_by_year_by_idEmployee`(
    idEmployee INT,
    year INT
)
BEGIN
	SELECT * FROM `payroll` WHERE 
	    ((`payroll`.`fortnight` IN (23, 24) AND
        `payroll`.`year` = year - 1) OR
        (`payroll`.`fortnight` BETWEEN 1 AND 22 AND
        `payroll`.`year` = year)) AND
        `payroll`.`idEmployee` = idEmployee AND
        `payroll`.`isDeleted` = 0
        ORDER BY `payroll`.`fortnight` ASC;
END//

CREATE PROCEDURE `sp_insert_payroll`(
    idEmployee INT,
    position VARCHAR(25),
    type VARCHAR(7),
    salary DECIMAL(11,2),
    location VARCHAR(14),
    fortnight INT,
    year INT,
    workingDays INT,
    ordinaryTimeHours INT,
    extraTimeHours INT,
    doubleTimeHours INT,
    vacationsDays INT,
    vacationAmount DECIMAL(11,2),
    ccssDays INT,
    ccssAmount DECIMAL(11,2),
    insDays INT,
    insAmount DECIMAL(11,2),
    salaryBonus DECIMAL(11,2),
    incentives DECIMAL(11,2),
    surcharges DECIMAL(11,2),
    maternityDays INT,
    maternityAmount DECIMAL(11,2),
    observations VARCHAR(500)
)
BEGIN
	INSERT INTO `payroll` (
        `idEmployee`,
        `position`,
        `type`,
        `salary`,
        `location`,
        `fortnight`,
        `year`,
        `workingDays`,
        `ordinaryTimeHours`,
        `extraTimeHours`,
        `doubleTimeHours`,
        `vacationsDays`,
        `vacationAmount`,
        `ccssDays`,
        `ccssAmount`,
        `insDays`,
        `insAmount`,
        `salaryBonus`,
        `incentives`,
        `surcharges`,
        `maternityDays`,
        `maternityAmount`,
        `observations`
        ) VALUES (
            idEmployee,
            position,
            type,
            salary,
            location,
            fortnight,
            year,
            workingDays,
            ordinaryTimeHours,
            extraTimeHours,
            doubleTimeHours,
            vacationsDays,
            vacationAmount,
            ccssDays,
            ccssAmount,
            insDays,
            insAmount,
            salaryBonus,
            incentives,
            surcharges,
            maternityDays,
            maternityAmount,
            observations);
    SELECT LAST_INSERT_ID() as id; 
END//

CREATE PROCEDURE `sp_update_payroll`(
    id INT,
	idEmployee INT,
    position VARCHAR(25),
    type VARCHAR(7),
    salary DECIMAL(11,2),
    location VARCHAR(14),
    fortnight INT,
    year INT,
    workingDays INT,
    ordinaryTimeHours INT,
    extraTimeHours INT,
    doubleTimeHours INT,
    vacationsDays INT,
    vacationAmount DECIMAL(11,2),
    ccssDays INT,
    ccssAmount DECIMAL(11,2),
    insDays INT,
    insAmount DECIMAL(11,2),
    salaryBonus DECIMAL(11,2),
    incentives DECIMAL(11,2),
    surcharges DECIMAL(11,2),
    maternityDays INT,
    maternityAmount DECIMAL(11,2),
    observations VARCHAR(500)
)
BEGIN
	UPDATE `payroll`
    SET `idEmployee` = idEmployee,
        `position` = position,
        `type` = type,
        `salary` = salary,
        `location` = location,
        `fortnight` = fortnight,
        `year` = year,
        `workingDays` = workingDays,
        `ordinaryTimeHours` = ordinaryTimeHours,
        `extraTimeHours` = extraTimeHours,
        `doubleTimeHours` = doubleTimeHours,
        `vacationsDays` = vacationsDays,
        `vacationAmount` = vacationsDays,
        `ccssDays` = ccssDays,
        `ccssAmount` = ccssAmount,
        `insDays` = insDays,
        `insAmount` = insAmount,
        `salaryBonus` = salaryBonus,
        `incentives` = incentives,
        `surcharges` = surcharges,
        `maternityDays` = maternityDays,
        `maternityAmount` = maternityAmount,
        `observations` = observations
    WHERE `payroll`.`id` = id;
END//

CREATE PROCEDURE `sp_remove_payroll`(
	id INT
)
BEGIN
	UPDATE `payroll`
    SET `isDeleted` = 1
    WHERE `payroll`.`id` = id;
END//

CREATE PROCEDURE `sp_check_inserted`(
	idEmployee INT,
    fortnight INT,
    year INT
)
BEGIN
	SELECT `id` FROM `payroll` WHERE `payroll`.`idEmployee` = idEmployee AND
         `payroll`.`fortnight` = fortnight AND `payroll`.`year` = year;
END//
