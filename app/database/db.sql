CREATE DATABASE veterinaria;
USE veterinaria;


CREATE TABLE propietarios(
  idpropietario   INT PRIMARY KEY AUTO_INCREMENT,
  apellidos       VARCHAR(50) NOT NULL,
  nombres         VARCHAR(50) NOT NULL
)ENGINE = INNODB;


CREATE TABLE mascotas(
  idmascota       INT PRIMARY KEY AUTO_INCREMENT,
  idpropietario   INT NOT NULL,
  tipo            ENUM('perro', 'gato') NOT NULL,
  NOMBRE          VARCHAR(50) NOT NULL,
  color           VARCHAR(50) NOT NULL,
  genero          ENUM('macho', 'hembra') NOT NULL,
  vive            ENUM('si', 'no') NOT NULL DEFAULT 'si',
  CONSTRAINT fk_idpropietario FOREIGN KEY (idpropietario) REFERENCES propietarios(idpropietario) 
)ENGINE = INNODB; 

INSERT INTO propietarios (apellidos, nombres) VALUES
('Perez', 'Juan'),
('Gomez', 'Maria');

INSERT INTO mascotas (idpropietario, tipo, NOMBRE, color, genero) VALUES
(1, 'perro', 'Firulais', 'marron', 'macho'),
(1, 'gato', 'Miau', 'blanco', 'hembra'),
(2, 'perro', 'Betove', 'negro', 'macho'),
(2, 'gato', 'Miau2', 'gris', 'hembra');

SELECT * FROM mascotas;

UPDATE mascotas SET idpropietario = 1, tipo = 'perro', nombre = 'Matador', color = 'Chocolate', genero = 'macho' WHERE idmascota = 2;

SELECT 
  MA.idmascota,
  MA.nombre,
  MA.tipo,
  MA.color,
  MA.genero,
  CONCAT(PR.apellidos, ' ', PR.nombres) 'propietario'
  FROM mascotas MA
  INNER JOIN propietarios PR ON ma.idpropietario = PR.idpropietario
  ORDER BY MA.nombre;