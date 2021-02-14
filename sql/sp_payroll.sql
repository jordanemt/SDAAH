CREATE PROCEDURE `sp_get_payroll`(
	id INT
)
BEGIN
	SELECT* FROM `payroll` WHERE `payroll`.`id` = id AND `payroll`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_by_filter_payroll`(
    fortnight INT,
	year INT,
    location VARCHAR(50)
)
BEGIN
	SELECT* FROM `payroll` WHERE 
        `payroll`.`isDeleted` = 0 AND 
        `payroll`.`location` REGEXP location AND
        `payroll`.`fortnight` = fortnight AND
        `payroll`.`year` = year;
END//

CREATE PROCEDURE `sp_get_all_payroll`()
BEGIN
	SELECT* FROM `payroll` WHERE `payroll`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_insert_payroll`(
	idEmployee INT,
    location VARCHAR(14),
    fortnight INT,
    year INT,
    type VARCHAR(7),
    salary DECIMAL(11,2),
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
        `location`,
        `fortnight`,
        `year`,
        `type`,
        `salary`,
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
            location,
            fortnight,
            year,
            type,
            salary,
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
    location VARCHAR(14),
    fortnight INT,
    year INT,
    type VARCHAR(7),
    salary DECIMAL(11,2),
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
        `location` = location,
        `fortnight` = fortnight,
        `year` = year,
        `type` = type,
        `salary` = salary,
        `workingDays` = salary,
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