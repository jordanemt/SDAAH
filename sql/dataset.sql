INSERT INTO `user` (`id`, `card`, `pass`, `firstLastName`, `secondLastName`, `name`, `email`, `role`, `isDeleted`) VALUES
(1, '303130141', '652d5da048b5d79c6a45b62de9268b98', 'Delgado', 'Durán', 'Luis Fernando', 'ldelgado_2000@yahoo.com', 3, 0);

INSERT INTO `deduction` (`id`, `name`, `isDeleted`) VALUES
(1, 'Ahorro Asociación Solidarista', 0),
(2, 'Adelanto de Cesantía', 0),
(3, 'Préstamo Asociación Solidarista', 0),
(4, 'Anticipo Salarial', 0),
(5, 'Ahorro Extraordinario', 0),
(6, 'Embargo Salarial', 0),
(7, 'Pensión Alimenticia', 0),
(8, 'Préstamo Vehículo', 0);

INSERT INTO `position` (`id`, `cod`, `name`, `type`, `salary`, `isDeleted`) VALUES
(1, '1120', 'Administrador', 'Mensual', '857530.00', 0),
(2, '4109', 'Auxiliar Administrativo', 'Mensual', '426780.00', 0),
(3, '7126', 'Fontanero', 'Diario', '1791.00', 0),
(4, '9152', 'Guarda Oficina', 'Mensual', '476467.00', 0),
(5, '4110', 'Oficinista', 'Mensual', '342025.00', 0);

INSERT INTO `employee` (`id`, `card`, `firstLastName`, `secondLastName`, `name`, `gender`, `birthdate`, `idPosition`, `location`, `admissionDate`, `bank`, `bankAccount`, `email`, `cssIns`, `isAffiliated`, `isLiquidated`, `observations`, `isDeleted`) VALUES
(1, '117920961', 'Aguilar', 'Hidalgo', 'María José', 'Femenino', '2000-10-20', 5, 'Administrativo', '2020-10-05', 'BNCR', '200010170984404', 'mariaaguilarh09@gmail.com', '4109', 0, 0, NULL, 0),
(2, '303130141', 'Delgado', 'Durán', 'Luis Fernando', 'Masculino', '1971-08-03', 1, 'Administrativo', '2019-12-01', 'BNCR', '200010170656652', 'ldelgado_2000@yahoo.com', '1122', 0, 0, NULL, 0),
(3, '113980048', 'Sandí', 'Rodríguez', 'Stephanie María', 'Femenino', '1989-07-21', 2, 'Administrativo', '2019-12-01', 'BNCR', '200010170429354', 'fannybebe21@gmail.com', '4149', 0, 0, NULL, 0),
(4, '115930322', 'Elizondo', 'Brenes', 'Steven Jesús', 'Masculino', '1994-12-26', 3, 'Operativo', '2019-12-01', 'BNCR', '200010009297995', 'stevenbre03@gmail.com', '7136', 0, 0, NULL, 0),
(5, '302600857', 'Herrera', 'Brenes', 'Manuel Jesús', 'Masculino', '1963-12-26', 3, 'Operativo', '2019-12-01', 'BNCR', '200010170742990', NULL, '7136', 0, 0, NULL, 0),
(6, '702230137', 'Herrera', 'Víquez', 'Fernelly Manuel', 'Masculino', '1993-10-07', 3, 'Operativo', '2019-12-01', 'BNCR', '200010170630130', 'fer93manuel@gmail.com', '7136', 0, 0, NULL, 0),
(7, '700750502', 'Salas', 'Chavarría', 'Raúl Enrique', 'Masculino', '1963-03-18', 4, 'Operativo', '2019-12-01', 'BNCR', '200010170740564', NULL, '9152', 0, 0, NULL, 0);

INSERT INTO `incometax` (`id`, `section`, `percentage`, `isDeleted`) VALUES
(1, '817000.00', '10.00', 0),
(2, '1226000.00', '15.00', 0);

INSERT INTO `param` (`id`, `name`, `percentage`, `isDeleted`) VALUES 
('1', 'Seguro Social', '10.5', '0'), 
('2', 'CCSS (RPL)', '26.33', '0'), 
('3', 'Aguinaldo (RPL)', '8.33', '0'), 
('4', 'Vacaciones (RPL)', '4.16', '0'), 
('5', 'Pre-Aviso (RPL)', '4.16', '0'), 
('6', 'Cesantia (RPL)', '8.33', '0'), 
('7', 'Ley PT (RPL)', '4.75', '0');