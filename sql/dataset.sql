INSERT INTO `user` (`id`, `card`, `pass`, `firstLastName`, `secondLastName`, `name`, `email`, `role`, `isDeleted`) VALUES
(1, '000000000', '645a8aca5a5b84527c57ee2f153f1946', 'admin', 'admin', 'admin', 'admin@admin.com', 3, 0),
(2, '111111111', 'adbc91a43e988a3b5b745b8529a90b61', 'dig', 'dig', 'dig', 'dig@dig.com', 2, 0),
(3, '222222222', '13723a026a1a9b499f0e9f9fb8f4f6ad', 'con', 'con', 'con', 'con@con.com', 1, 0);

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
(1, '1120', 'Administrador', 'Mensual', '854962.48', 0),
(2, '4109', 'Auxiliar Administrativo', 'Mensual', '425500.00', 0),
(3, '7126', 'Fontanero', 'Diario', '1786.00', 0),
(4, '9152', 'Guarda Oficina', 'Mensual', '475042.00', 0),
(5, '4109', 'Oficinista', 'Mensual', '341004.00', 0);

INSERT INTO `employee` (`id`, `card`, `firstLastName`, `secondLastName`, `name`, `gender`, `birthdate`, `idPosition`, `location`, `admissionDate`, `bankAccount`, `email`, `cssIns`, `isAffiliated`, `isLiquidated`, `observations`, `isDeleted`) VALUES
(1, '117920961', 'Aguilar', 'Hidalgo', 'María José', 'Femenino', '2000-10-20', 5, 'Administrativo', '2020-10-05', '200010170984404', 'mariaaguilarh09@gmail.com', '4109', 0, 0, NULL, 0),
(2, '303130141', 'Delgado', 'Durán', 'Luis Fernando', 'Masculino', '1971-08-03', 1, 'Administrativo', '2019-12-01', '200010170656652', 'ldelgado_2000@yahoo.com', '1122', 0, 0, NULL, 0),
(3, '113980048', 'Sandí', 'Rodríguez', 'Stephanie María', 'Femenino', '1989-07-21', 2, 'Administrativo', '2019-12-01', '200010170429354', 'fannybebe21@gmail.com', '4149', 0, 0, NULL, 0),
(4, '115930322', 'Elizondo', 'Brenes', 'Steven Jesús', 'Masculino', '1994-12-26', 3, 'Operativo', '2019-12-01', '20010009297995', 'stevenbre03@gmail.com', '7136', 0, 0, NULL, 0),
(5, '302600857', 'Herrera', 'Brenes', 'Manuel Jesús', 'Masculino', '1963-12-26', 3, 'Operativo', '2019-12-01', '200010170742990', NULL, '7136', 0, 0, NULL, 0),
(6, '702230137', 'Herrera', 'Víquez', 'Fernelly Manuel', 'Masculino', '1993-10-07', 3, 'Operativo', '2019-12-01', '200010170630130', 'fer93manuel@gmail.com', '7136', 0, 0, NULL, 0),
(7, '700750502', 'Salas', 'Chavarría', 'Raúl Enrique', 'Masculino', '1963-03-18', 4, 'Operativo', '2019-12-01', '200010170740564', NULL, '9152', 0, 0, NULL, 0);

INSERT INTO `param` (`id`, `name`, `percentage`, `isDeleted`) VALUES 
('1', 'Seguro Social', '10.5', '0'), 
('2', 'CCSS', '26.33', '0'), 
('3', 'Aguinaldo', '8.33', '0'), 
('4', 'Vacaciones', '4.16', '0'), 
('5', 'Pre-Aviso', '4.16', '0'), 
('6', 'Cesantia', '8.33', '0'), 
('7', 'Ley PT', '4.75', '0');