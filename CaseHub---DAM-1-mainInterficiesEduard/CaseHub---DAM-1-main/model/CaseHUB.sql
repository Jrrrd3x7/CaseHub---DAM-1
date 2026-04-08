-- Generar base de datos para CaseHUB --
-- CaseHUB --
-- Jordi Baez, Ivan Forner, Daniel Lop, Eduard Caringal -- 
-- 05/12/2025 (Formato: DD/MM/AAAA) --

-- CREATE DATABASE CASEHUB --
CREATE DATABASE IF NOT EXISTS CaseHub;
USE CaseHub;

-- RESET DATABASE --
DROP TABLE IF EXISTS Users;

DROP PROCEDURE IF EXISTS PrintUsers;
DROP PROCEDURE IF EXISTS CreateUser;

CREATE TABLE Users(
	ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	Name VARCHAR(100) NOT NULL,
	Surname VARCHAR(100) NOT NULL,
	Email VARCHAR(100) NOT NULL UNIQUE,
	Country VARCHAR(100) NOT NULL,
	Password VARCHAR(255) NOT NULL
);
INSERT INTO Users(Name,Surname,Email,Country,Password)
VALUES
('Jordi','Messi','jordi@email.com','España','jordi123');

-- PRINT USERS -- 
DELIMITER $$
CREATE PROCEDURE PrintUsers()
BEGIN
    SELECT
		Users.ID AS ID,
        Users.Name AS Name,
        Users.Surname AS Surname,
        Users.Email AS Email,
        Users.Country AS Country,
        Users.Password AS Password
    FROM Users;
END $$
DELIMITER ;

-- CREATE USER --
DELIMITER $$
	CREATE PROCEDURE CreateUser (
		IN pName VARCHAR(100), 
		IN pSurname VARCHAR(100), 
		IN pEmail VARCHAR(100),
		IN pCountry VARCHAR(100),
		IN pPassword VARCHAR(100)
	)
	BEGIN
		INSERT INTO Users(Name,Surname,Email,Country,Password)
		VALUES (pName,pSurname,pEmail,pCountry,pPassword);
	END $$
DELIMITER ;


-- EXECUTE --
CALL PrintUsers();
CALL CreateUser('Daniil','Maximov','dmaximov@email.com','Rusia','dmx123');
CALL PrintUsers();
