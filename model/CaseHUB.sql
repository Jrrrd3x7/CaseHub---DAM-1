-- Generar base de datos para CaseHUB --
-- CaseHUB --
-- Jordi Baez, Ivan Forner, Daniel Lop, Eduard Caringal -- 
-- 05/12/2025 (Formato: DD/MM/AAAA) --

-- Creacion tablas Clientes --
create database IF NOT EXISTS casehub;
USE casehub;
CREATE TABLE Clientes(
id_cliente int auto_increment,
nombre_cliente varchar(100) not null,
numero_telefono int default 11,
email varchar (100) not null,
fecha_nacimiento varchar(8),
pais varchar(100),
provincia varchar(100),
direccion varchar(200),
codigo_postal int default 15,
numero_tarjeta int,
contraseña varchar(50) not null,
constraint PK_Clientes primary key (id_cliente)
);


-- Creacion tablas Suscripciones --
use casehub;
CREATE TABLE Suscripciones (
    id_suscripcion int primary key auto_increment,
    id_cliente int not null,
    tipo_suscripcion varchar(50) not null,
    fecha_inicio  varchar(8) not null,
    fecha_fin varchar(8),
    CONSTRAINT FK_Suscripciones_Clientes
	FOREIGN KEY (id_cliente)
	REFERENCES Clientes(id_cliente)
	ON DELETE CASCADE
);
