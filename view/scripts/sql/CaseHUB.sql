-- Generar base de datos para CaseHUB --
-- CaseHUB --
-- Jordi Baez, Ivan Forner, Daniel Lop, Eduard Caringal -- 
-- 05/12/2025 (Formato: DD/MM/AAAA) --

-- Creacion tablas Clientes --
IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'CaseHUB')
BEGIN
	CREATE DATABASE CaseHUB;
END
USE CaseHUB;

CREATE TABLE Clients(
	ID int IDENTITY(1,1) PRIMARY KEY,
	Nombre varchar(100) NOT NULL,
	Telefono int DEFAULT 11,
	Email varchar(100) NOT NULL,
	BirthDate varchar(8),
	Pais varchar(100),
	Provincia varchar(100),
	Direccion varchar(200),
	CodigoPostal int DEFAULT 15,
	Targeta int,
	Contraseña varchar(50) NOT NULL
);

-- Creacion tablas Suscripciones --
CREATE TABLE Subscription (
	ID int IDENTITY(1,1) PRIMARY KEY,
	ClientID int NOT NULL,
	SubType varchar(50) NOT NULL,
	StartDate varchar(8) NOT NULL,
	FinishDate varchar(8),
	CONSTRAINT FK_Suscripciones_Clientes
		FOREIGN KEY (ID)
		REFERENCES Client(ID)
		ON DELETE CASCADE
);
