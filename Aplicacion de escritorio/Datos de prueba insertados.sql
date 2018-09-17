INSERT INTO `evento` (`id`, `nombre`, `lugar`, `fecha`, `horainicio`, `horafin`, `detalle`, `nombre_foro`) 
VALUES ('2', 'IPOO', 'UNS', '2017-11-08', '12:00:00', '14:00:00', 'programacion orientada a objetos, probando a ver cuan largo es el texto, 
si llego hasta los dos puntos quiere decir que se la banca, bueno, seguimos agregando a ver que onda, 
es un texto de mas o menos 200 palabras supongo ..','arfitec'),('3', 'LFYA', 'UNS', '2017-11-09', '09:00:00', '11:00:00', 'lenguajes formales, vemos que onda, si llega lejos o no', 'arfitec'),
('4', 'ED', 'UNS', '2017-11-10', '14:00:00', '16:00:00', 'estructuras de datos, probando que onda', 'arfitec'), 
('5', 'F1', 'UNS', '2017-11-10', '15:00:00', '17:00:00', 'fisica 1, probando tambien que ondeli', 'arfitec'),
('1', 'SE', 'UNS', '2017-11-23', '15:00:00', '17:00:00', 'Sistemas embebidos 2017', 'arfitec');

INSERT INTO `evento_ingles` (`id`, `nombre`, `lugar`, `fecha`, `horainicio`, `horafin`, `detalle`, `nombre_foro`) 
VALUES ('2', 'IPOO', 'UNS', '2017-11-08', '12:00:00', '14:00:00', 'programacion orientada a objetos, probando a ver cuan largo es el texto, 
si llego hasta los dos puntos quiere decir que se la banca, bueno, seguimos agregando a ver que onda, 
es un texto de mas o menos 200 palabras supongo ..','arfitec'),
('3', 'LFYA', 'UNS', '2017-11-09', '09:00:00', '11:00:00', 'lenguajes formales, vemos que onda, si llega lejos o no', 'arfitec'),
('4', 'ED', 'UNS', '2017-11-10', '14:00:00', '16:00:00', 'estructuras de datos, probando que onda', 'arfitec'), 
('5', 'F1', 'UNS', '2017-11-10', '15:00:00', '17:00:00', 'fisica 1, probando tambien que ondeli', 'arfitec'),
('1', 'SE', 'UNS', '2017-11-23', '15:00:00', '17:00:00', 'Sistemas embebidos 2017', 'arfitec');

INSERT INTO `evento_frances` (`id`, `nombre`, `lugar`, `fecha`, `horainicio`, `horafin`, `detalle`, `nombre_foro`) 
VALUES ('2', 'IPOO', 'UNS', '2017-11-08', '12:00:00', '14:00:00', 'programacion orientada a objetos, probando a ver cuan largo es el texto, 
si llego hasta los dos puntos quiere decir que se la banca, bueno, seguimos agregando a ver que onda, 
es un texto de mas o menos 200 palabras supongo ..','arfitec'),
('3', 'LFYA', 'UNS', '2017-11-09', '09:00:00', '11:00:00', 'lenguajes formales, vemos que onda, si llega lejos o no', 'arfitec'),
('4', 'ED', 'UNS', '2017-11-10', '14:00:00', '16:00:00', 'estructuras de datos, probando que onda', 'arfitec'), 
('5', 'F1', 'UNS', '2017-11-10', '15:00:00', '17:00:00', 'fisica 1, probando tambien que ondeli', 'arfitec'),
('1', 'SE', 'UNS', '2017-11-23', '15:00:00', '17:00:00', 'Sistemas embebidos 2017', 'arfitec');
  
 INSERT INTO `eventoacademico` (`id`, `nombre`, `aula`) VALUES 
 ('1', 'SE', 'UNS'),('2', 'IPOO', 'UNS'), ('3', 'LFYA', 'UNS'),('4', 'ED', 'UNS'), ('5', 'F1', 'UNS');

  INSERT INTO `eventoacademico_ingles` (`id`, `nombre`, `aula`) VALUES 
 ('1', 'SE', 'UNS'),('2', 'IPOO', 'UNS'), ('3', 'LFYA', 'UNS'),('4', 'ED', 'UNS'), ('5', 'F1', 'UNS');
 
  INSERT INTO `eventoacademico_frances` (`id`, `nombre`, `aula`) VALUES 
 ('1', 'SE', 'UNS'),('2', 'IPOO', 'UNS'), ('3', 'LFYA', 'UNS'),('4', 'ED', 'UNS'), ('5', 'F1', 'UNS');
 
 INSERT INTO `usuario` (`username`,`password`,`nombre_usuario`,`apellido`, `dni`, `es_admin`) VALUES ('josesito','123','Jose', 'Moyano', '38919917', 0), ('soniecita','123','Sonia', 'Rueda', '38919918', 0);
 INSERT INTO `usuario` (`username`,`password`,`nombre_usuario`, `apellido`, `dni`, `es_admin`) VALUES ('anita','123','Ana', 'Maguitman', '38919919', 0), ('sergito','123','Sergio', 'Gomez', '38919920', 0);
 INSERT INTO `usuario` (`username`,`password`,`nombre_usuario`, `apellido`, `dni`, `es_admin`) VALUES ('paulita','123','Paula', 'Jasen', '38919921', 0);
 INSERT INTO USUARIO VALUES ("admin","asd","leandro", "Perez",'38919922', 1);
 INSERT INTO `expositor` (`dni`, `institucion`, `cargo`, `biografia`) VALUES ('38919917', 'UNS', 'profesor', 'aca la biografia del wachin'),
 ('38919918', 'UNS', 'doctora', 'que se yo que ondeli'), 
 ('38919919', 'UNS', 'doctora', 'probanding'), 
 ('38919920', 'UNS', 'doctor', 'probandouuuuuuu'), 
 ('38919921', 'UNS', 'profesora', 'probando el texto con algo distinto');
 
 INSERT INTO `expositor_ingles` (`dni`, `institucion`, `cargo`, `biografia`) VALUES ('38919917', 'UNS', 'profesor', 'aca la biografia del wachin'),
 ('38919918', 'UNS', 'doctora', 'que se yo que ondeli'), 
 ('38919919', 'UNS', 'doctora', 'probanding'), 
 ('38919920', 'UNS', 'doctor', 'probandouuuuuuu'), 
 ('38919921', 'UNS', 'profesora', 'probando el texto con algo distinto');
 
 INSERT INTO `expositor_frances` (`dni`, `institucion`, `cargo`, `biografia`) VALUES ('38919917', 'UNS', 'profesor', 'aca la biografia del wachin'),
 ('38919918', 'UNS', 'doctora', 'que se yo que ondeli'), 
 ('38919919', 'UNS', 'doctora', 'probanding'), 
 ('38919920', 'UNS', 'doctor', 'probandouuuuuuu'), 
 ('38919921', 'UNS', 'profesora', 'probando el texto con algo distinto');
 
 INSERT INTO `presenta` (`dni`, `id`) VALUES ('38919917', '1'), ('38919918', '2'), ('38919919', '3'), ('38919920', '4'), ('38919921', '5');
 INSERT INTO `presenta_ingles` (`dni`, `id`) VALUES ('38919917', '1'), ('38919918', '2'), ('38919919', '3'), ('38919920', '4'), ('38919921', '5');
 INSERT INTO `presenta_frances` (`dni`, `id`) VALUES ('38919917', '1'), ('38919918', '2'), ('38919919', '3'), ('38919920', '4'), ('38919921', '5');
 
 
 INSERT INTO `asiste` (`dni`,`id`) VALUES('38919922','1'), ('38919922','2'), ('38919922','3'), ('38919922','4');
 INSERT INTO `asiste_ingles` (`dni`,`id`) VALUES('38919922','1'), ('38919922','2'), ('38919922','3'), ('38919922','4');
 INSERT INTO `asiste_frances` (`dni`,`id`) VALUES('38919922','1'), ('38919922','2'), ('38919922','3'), ('38919922','4');
 
INSERT INTO `ciudad` (`cod_postal`, `nombre`, `inf_turistica`) VALUES ('8000', 'Bahia blanca', 'informacion de bahia blanca, es un pueblo grande');
INSERT INTO `ciudad_ingles` (`cod_postal`, `nombre`, `inf_turistica`) VALUES ('8000', 'Bahia blanca', 'informacion de bahia blanca, es un pueblo grande');
INSERT INTO `ciudad_frances` (`cod_postal`, `nombre`, `inf_turistica`) VALUES ('8000', 'Bahia blanca', 'informacion de bahia blanca, es un pueblo grande');

INSERT INTO `foro` (`codigo`,`nombre`, `detalle`, `cod_postal`) VALUES ('8000','Foro arfitec', 'El congreso ha de realizarse en la universidad nacional del sur', '8000');
INSERT INTO `foro_ingles` (`codigo`,`nombre`, `detalle`, `cod_postal`) VALUES ('8000','Foro arfitec', 'El congreso ha de realizarse en la universidad nacional del sur', '8000');
INSERT INTO `foro_frances` (`codigo`,`nombre`, `detalle`, `cod_postal`) VALUES ('8000','Foro arfitec', 'El congreso ha de realizarse en la universidad nacional del sur', '8000');
 

