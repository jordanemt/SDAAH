CREATE PROCEDURE `sp_get_payment`(
	id INT
)
BEGIN
	SELECT* FROM `payment` WHERE `payment`.`id` = id AND `payment`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_by_idEmployee_and_fortnight_and_year_payment`(
    idEmployee INT,
    fortnight INT,
	year INT
)
BEGIN
	SELECT* FROM `payment` WHERE `payment`.`idEmployee` = idEmployee AND 
        `payment`.`fortnight` = fortnight AND
        `payment`.`year` = year AND 
        `payment`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_by_filter_biweekly_payment`(
    fortnight INT,
	year INT,
    location VARCHAR(25)
)
BEGIN
	SELECT* FROM `payment` WHERE  
        `payment`.`location` REGEXP location AND
        `payment`.`fortnight` = fortnight AND
        `payment`.`year` = year AND 
        `payment`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_by_filter_monthly_payment`(
    month INT,
	year INT
)
BEGIN
	SELECT* FROM `payment` WHERE  
        `payment`.`fortnight` IN ((month * 2), (month * 2 - 1)) AND
        `payment`.`year` = year AND 
        `payment`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_payment`()
BEGIN
	SELECT* FROM `payment` WHERE `payment`.`isDeleted` = 0;
END//

CREATE PROCEDURE `sp_get_all_on_bonus_by_year_by_idEmployee_payment`(
    idEmployee INT,
    year INT
)
BEGIN
	SELECT * FROM `payment` WHERE 
	    ((`payment`.`fortnight` IN (23, 24) AND
        `payment`.`year` = year - 1) OR
        (`payment`.`fortnight` BETWEEN 1 AND 22 AND
        `payment`.`year` = year)) AND
        `payment`.`idEmployee` = idEmployee AND
        `payment`.`isDeleted` = 0
        ORDER BY `payment`.`fortnight` ASC;
END//

CREATE PROCEDURE `sp_insert_payment`(
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
    observations VARCHAR(500),
    ordinary DECIMAL(11,2),
    extra DECIMAL(11,2),
    doubleS DECIMAL(11,2),
    gross DECIMAL(11,2),
    workerCCSS DECIMAL(11,2),
    incomeTax DECIMAL(11,2),
    deductionsTotal DECIMAL(11,2),
    net DECIMAL(11,2)
)
BEGIN
	INSERT INTO `payment` (
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
        `observations`,
        `ordinary`,
        `extra`,
        `double`,
        `gross`,
        `workerCCSS`,
        `incomeTax`,
        `deductionsTotal`,
        `net`
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
            observations,
            ordinary,
            extra,
            doubleS,
            gross,
            workerCCSS,
            incomeTax,
            deductionsTotal,
            net);
    SELECT LAST_INSERT_ID() as id; 
END//

CREATE PROCEDURE `sp_update_payment`(
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
    observations VARCHAR(500),
    ordinary DECIMAL(11,2),
    extra DECIMAL(11,2),
    doubleS DECIMAL(11,2),
    gross DECIMAL(11,2),
    workerCCSS DECIMAL(11,2),
    incomeTax DECIMAL(11,2),
    deductionsTotal DECIMAL(11,2),
    net DECIMAL(11,2)
)
BEGIN
	UPDATE `payment`
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
        `vacationAmount` = vacationAmount,
        `ccssDays` = ccssDays,
        `ccssAmount` = ccssAmount,
        `insDays` = insDays,
        `insAmount` = insAmount,
        `salaryBonus` = salaryBonus,
        `incentives` = incentives,
        `surcharges` = surcharges,
        `maternityDays` = maternityDays,
        `maternityAmount` = maternityAmount,
        `observations` = observations,
        `ordinary` = ordinary,
        `extra` = extra,
        `double` = doubleS,
        `gross` = gross,
        `workerCCSS` = workerCCSS,
        `incomeTax` = incomeTax,
        `deductionsTotal` = deductionsTotal,
        `net` = net
    WHERE `payment`.`id` = id;
END//

CREATE PROCEDURE `sp_remove_payment`(
	id INT
)
BEGIN
	UPDATE `payment`
    SET `isDeleted` = 1
    WHERE `payment`.`id` = id;
END//
