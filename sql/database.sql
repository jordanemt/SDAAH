CREATE TABLE `user` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    card VARCHAR(9) NOT NULL,
    pass VARCHAR(32) NOT NULL,
    firstLastName VARCHAR(25) NOT NULL,
    secondLastName VARCHAR(25) NOT NULL,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role INT NOT NULL CHECK(role IN (1, 2, 3)),
    isDeleted BOOL NOT NULL DEFAULT 0
);

CREATE TABLE position (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cod INT NOT NULL,
    name VARCHAR(25) NOT NULL,
    type INT NOT NULL CHECK(type IN (1, 2)),
    salary DECIMAL(11,2) NULL,
    ordinaryTime DECIMAL(11,2) NULL,
    extraTime DECIMAL(11,2) NULL,
    doubleTime DECIMAL(11,2) NULL,
    isDeleted BOOL NOT NULL DEFAULT 0
);
