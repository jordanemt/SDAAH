CREATE TABLE `user` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `card` VARCHAR(9) NOT NULL,
    `pass` VARCHAR(32) NOT NULL,
    `firstLastName` VARCHAR(25) NOT NULL,
    `secondLastName` VARCHAR(25) NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `role` INT NOT NULL CHECK(role IN (1, 2, 3)),
    `isDeleted` BOOL NOT NULL DEFAULT 0
);

