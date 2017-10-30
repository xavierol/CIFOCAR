DROP DATABASE IF EXISTS cifocar;

CREATE DATABASE cifocar;

USE cifocar;


/* -----------------------------------------------------
-- Table usuarios --
-- ---------------------------------------------------*/


DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
	id int NOT NULL AUTO_INCREMENT,   
	user varchar(32) NOT NULL,
	password varchar(32) NOT NULL,
	nombre varchar(32) NOT NULL,
	privilegio int(11) NOT NULL,
	email varchar(128) NOT NULL,
	admin int(11) NOT NULL,
	imagen varchar(512) NOT NULL,
	fecha timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;





/* -----------------------------------------------------
-- Table marcas --
-- ---------------------------------------------------*/
DROP TABLE IF EXISTS marcas;
CREATE TABLE marcas (
	marca VARCHAR(32),
	PRIMARY KEY (marca)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


/* -----------------------------------------------------
-- Table vehicle --
-- ---------------------------------------------------*/
DROP TABLE IF EXISTS vehiculos;
CREATE TABLE vehiculos (
	id INT NOT NULL AUTO_INCREMENT,
	matricula CHAR(8) NOT NULL,
	modelo VARCHAR(32) NOT NULL,
	color VARCHAR(32) NOT NULL,
	precio_venta FLOAT NOT NULL,
	precio_compra FLOAT NOT NULL,
	kms INT NOT NULL,
	caballos INT NOT NULL,
	fecha_venta TIMESTAMP,
	estado INT NOT NULL,
	any_matriculacion INT NOT NULL,
	detalles TEXT NOT NULL,
	imagen VARCHAR(512) NOT NULL,
	vendedor INT,
	marca VARCHAR(32),
	PRIMARY KEY (id),
	FOREIGN KEY (vendedor) REFERENCES usuarios(id),
	FOREIGN KEY (marca) REFERENCES marcas(marca)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;






INSERT INTO usuarios (user, password, nombre, privilegio, email, admin, imagen, fecha)
VALUES('mserrano', '1234', 'Maribel Serrano', '0', 'm.serrano@informatica.cat', '1', 'rutafitxer');


