CREATE TABLE `user` (
    `id` INT AUTO_INCREMENT,
    `card` VARCHAR(9) NOT NULL,
    `pass` VARCHAR(32) NOT NULL,
    `firstLastName` VARCHAR(25) NOT NULL,
    `secondLastName` VARCHAR(25) NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `role` SMALLINT NOT NULL CHECK(role IN (1, 2, 3)),
    `isDeleted` BOOL NOT NULL DEFAULT 0,

    PRIMARY KEY(`id`)
);

CREATE TABLE `position` (
    `id` INT AUTO_INCREMENT,
    `cod` VARCHAR(4) NOT NULL,
    `name` VARCHAR(25) NOT NULL,
    `type` VARCHAR(7) NOT NULL CHECK(type IN ('Mensual', 'Diario')),
    `salary` DECIMAL(11,2) NOT NULL,
    `isDeleted` BOOL NOT NULL DEFAULT 0,

    PRIMARY KEY(`id`)
);

CREATE TABLE `employee` (
    `id` INT AUTO_INCREMENT,
    `card` VARCHAR(9) NOT NULL,
    `firstLastName` VARCHAR(25) NOT NULL,
    `secondLastName` VARCHAR(25) NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `gender` VARCHAR(9) NOT NULL CHECK(gender IN('Masculino', 'Femenino')),
    `birthdate` DATE NOT NULL,
    `idPosition` INT NOT NULL,
    `location` VARCHAR(14) NOT NULL CHECK(location IN('Administrativo', 'Operativo')),
    `admissionDate` DATE NOT NULL,
    `bank` VARCHAR(30) NOT NULL,
    `bankAccount` VARCHAR(30) NOT NULL,
    `email` VARCHAR(100) NULL,
    `cssIns` VARCHAR(4) NOT NULL,
    `isAffiliated` SMALLINT NOT NULL DEFAULT 0,
    `isLiquidated` SMALLINT NOT NULL DEFAULT 0,
    `observations` VARCHAR(500) NULL,
    `isDeleted` BOOL NOT NULL DEFAULT 0,
    
    PRIMARY KEY(`id`),
    FOREIGN KEY (`idPosition`) REFERENCES `position`(`id`)
);

CREATE TABLE `alimonybonus` (
    `id` INT AUTO_INCREMENT,
    `idEmployee` INT NOT NULL,
    `year` INT NOT NULL,
    `mount` DECIMAL(11,2) NOT NULL DEFAULT 0,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`idEmployee`) REFERENCES `employee`(`id`)
);

CREATE TABLE `deduction` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `isDeleted` BOOL NOT NULL DEFAULT 0,

    PRIMARY KEY(`id`)
);

CREATE TABLE `payment` (
    `id` INT AUTO_INCREMENT,
    `idEmployee` INT NOT NULL,
    `position` VARCHAR(29) NOT NULL,
    `type` VARCHAR(7) NOT NULL CHECK(type IN ('Mensual', 'Diario')),
    `salary` DECIMAL(11,2) NULL DEFAULT 0,
    `location` VARCHAR(14) NOT NULL CHECK(location IN('Administrativo', 'Operativo')),
    `fortnight` INT NOT NULL,
    `year` INT NOT NULL,
    `workingDays` INT NULL DEFAULT 0,
    `ordinaryTimeHours` INT NULL DEFAULT 0,
    `extraTimeHours` INT NULL DEFAULT 0,
    `doubleTimeHours` INT NULL DEFAULT 0,
    `vacationsDays` INT NULL DEFAULT 0,
    `vacationAmount` DECIMAL(11,2) NULL DEFAULT 0,
    `ccssDays` INT NULL DEFAULT 0,
    `ccssAmount` DECIMAL(11,2) NULL DEFAULT 0,
    `insDays` INT NULL DEFAULT 0,
    `insAmount` DECIMAL(11,2) NULL DEFAULT 0,
    `salaryBonus` DECIMAL(11,2) NULL DEFAULT 0,
    `incentives` DECIMAL(11,2) NULL DEFAULT 0,
    `surcharges` DECIMAL(11,2) NULL DEFAULT 0,
    `maternityDays` INT NULL DEFAULT 0,
    `maternityAmount` DECIMAL(11,2) NULL DEFAULT 0,
    `observations` VARCHAR(500) NULL,

    `ordinary` DECIMAL(11,2) NOT NULL,
    `extra` DECIMAL(11,2) NOT NULL,
    `double` DECIMAL(11,2) NOT NULL,
    `gross` DECIMAL(11,2) NOT NULL,
    `workerCCSS` DECIMAL(11,2) NOT NULL,
    `incomeTax` DECIMAL(11,2) NOT NULL,
    `deductionsTotal` DECIMAL(11,2) NOT NULL,
    `net` DECIMAL(11,2) NOT NULL,

    `isDeleted` BOOL NOT NULL DEFAULT 0,
    
    PRIMARY KEY(`id`),
    FOREIGN KEY(`idEmployee`) REFERENCES `employee`(`id`)
);

CREATE TABLE `payment_deduction` (
    `idPayment` INT NOT NULL,
    `idDeduction` INT NOT NULL,
    `mount` DECIMAL(11,2) NULL DEFAULT 0,

    PRIMARY KEY(`idPayment`, `idDeduction`),
    FOREIGN KEY (`idPayment`) REFERENCES `payment`(`id`),
    FOREIGN KEY (`idDeduction`) REFERENCES `deduction`(`id`)
);

CREATE TABLE `incometax` (
    `id` INT AUTO_INCREMENT,
    `section` DECIMAL(11,2) NOT NULL,
    `percentage` DECIMAL(11,2) NOT NULL DEFAULT 0,
    `isDeleted` BOOL NOT NULL DEFAULT 0,

    PRIMARY KEY(`id`)
);

CREATE TABLE `param` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `percentage` DECIMAL(11,2) NOT NULL DEFAULT 0,
    `isDeleted` BOOL NOT NULL DEFAULT 0,

    PRIMARY KEY(`id`)
);