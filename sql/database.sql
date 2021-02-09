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
    `cod` INT NOT NULL,
    `name` VARCHAR(25) NOT NULL,
    `type` VARCHAR(7) NOT NULL CHECK(type IN ('Mensual', 'Diario')),
    `salary` DECIMAL(11,2) NULL,
    `ordinaryTime` DECIMAL(11,2) NULL,
    `extraTime` DECIMAL(11,2) NULL,
    `doubleTime` DECIMAL(11,2) NULL,
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
    `bankAccount` BIGINT NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `cssIns` INT NOT NULL,
    `isAffiliated` SMALLINT NULL DEFAULT 0,
    `isLiquidated` SMALLINT NULL DEFAULT 0,
    `observations` VARCHAR(500) NULL,s
    `isDeleted` BOOL NOT NULL DEFAULT 0,
    
    PRIMARY KEY(`id`),
    FOREIGN KEY (`idPosition`) REFERENCES `position`(`id`)
);