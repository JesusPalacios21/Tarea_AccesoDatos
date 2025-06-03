CREATE DATABASE veterinaria;
USE veterinaria;

CREATE TABLE propietarios(
  idpropietario   INT PRIMARY KEY AUTO_INCREMENT,
  apellidos       VARCHAR(50) NOT NULL,
  nombres         VARCHAR(50) NOT NULL,
  dni             VARCHAR(8) NOT NULL,
  telefono        VARCHAR(9) NOT NULL,
  email           VARCHAR(50) NOT NULL,
  direccion       VARCHAR(100) NOT NULL
) ENGINE = INNODB;

CREATE TABLE mascotas(
  idmascota       INT PRIMARY KEY AUTO_INCREMENT,
  idpropietario   INT NOT NULL,
  tipo            ENUM('perro', 'gato') NOT NULL,
  NOMBRE          VARCHAR(50) NOT NULL,
  color           VARCHAR(50) NOT NULL,
  genero          ENUM('macho', 'hembra') NOT NULL,
  vive            ENUM('si', 'no') NOT NULL DEFAULT 'si',
  CONSTRAINT fk_idpropietario FOREIGN KEY (idpropietario) REFERENCES propietarios(idpropietario)
) ENGINE = INNODB;

-- Inserciones en la tabla propietarios con todos los campos
INSERT INTO propietarios (apellidos, nombres, dni, telefono, email, direccion) VALUES
('Perez', 'Juan', '12345678', '123456789', 'juanperez@example.com', 'Calle Ficticia 123'),
('Gomez', 'Maria', '87654321', '987654321', 'mariagomez@example.com', 'Avenida Central 456'),
('Lopez', 'Carlos', '11223344', '234567890', 'carloslopez@example.com', 'Calle Luna 789'),
('Martinez', 'Ana', '55667788', '345678901', 'anamartinez@example.com', 'Calle Sol 101'),
('Rodriguez', 'Luis', '99887766', '456789012', 'luisrodriguez@example.com', 'Boulevard Norte 202'),
('Hernandez', 'Laura', '22334455', '567890123', 'laurahernandez@example.com', 'Calle Mar 303'),
('Diaz', 'Pedro', '33445566', '678901234', 'pedro.diaz@example.com', 'Calle Verde 404'),
('Perez', 'Elena', '44556677', '789012345', 'elena.perez@example.com', 'Calle Real 505'),
('Gonzalez', 'Javier', '66778899', '890123456', 'javiergonzalez@example.com', 'Plaza Mayor 606'),
('Sanchez', 'Patricia', '77889900', '901234567', 'patriciasanchez@example.com', 'Avenida Libertad 707');

-- Inserciones en la tabla mascotas
INSERT INTO mascotas (idpropietario, tipo, NOMBRE, color, genero) VALUES
(1, 'perro', 'Firulais', 'marron', 'macho'),
(2, 'gato', 'Miau', 'blanco', 'hembra'),
(3, 'perro', 'Betove', 'negro', 'macho'),
(4, 'gato', 'Miau2', 'gris', 'hembra'),
(5, 'perro', 'Rex', 'negro', 'macho'),
(6, 'gato', 'Felix', 'naranja', 'macho'),
(7, 'perro', 'Max', 'blanco', 'macho'),
(8, 'gato', 'Tommy', 'gris', 'hembra'),
(9, 'perro', 'Rocky', 'marron', 'macho'),
(10, 'gato', 'Luna', 'blanco', 'hembra');

-- Ver todas las mascotas
SELECT * FROM mascotas;

-- Seleccionar mascotas con el nombre del propietario
SELECT 
  MA.idmascota,
  MA.nombre,
  MA.tipo,
  MA.color,
  MA.genero,
  CONCAT(PR.apellidos, ' ', PR.nombres) AS propietario
FROM mascotas MA
INNER JOIN propietarios PR ON MA.idpropietario = PR.idpropietario
ORDER BY MA.nombre;

-- Seleccionar propietarios con la cantidad de mascotas que tienen
SELECT 
  CONCAT(PR.apellidos, ' ', PR.nombres) AS propietario,
  COUNT(MA.idmascota) AS cantidad_mascotas
FROM propietarios PR
LEFT JOIN mascotas MA ON PR.idpropietario = MA.idpropietario
GROUP BY PR.idpropietario
ORDER BY cantidad_mascotas DESC;

SELECT 
  PR.idpropietario, 
  PR.apellidos, 
  PR.nombres, 
  PR.dni, 
  PR.telefono, 
  PR.email, 
  PR.direccion,
  MA.idmascota, 
  MA.nombre AS mascota
FROM propietarios PR
LEFT JOIN mascotas MA ON PR.idpropietario = MA.idpropietario
ORDER BY PR.idpropietario;

