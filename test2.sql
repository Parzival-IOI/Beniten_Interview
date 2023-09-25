-- 1. Please set data type and length for each field in all above tables’ fields


-- Table : staffs
-- #id (PK)         INT ()
-- name             VARCHAR (50)
-- sex (M or F)     CHAR
-- date_of_birth    DATE
-- address          VARCHAR (255)
-- phone            VARCHAR (25)

-- Table : positions
-- #id (PK)         INT ()
-- position         VARCHAR (255)        

-- Table : staff_positions
-- #id (PK)         INT ()
-- staff_id         INT ()
-- position_id      INT ()
-- start_date       DATE
-- end_date (If this is current position, end_date value will be null)

CREATE TABLE staffs (id INT PRIMARY KEY, name VARCHAR(50), sex CHAR, date_of_birth DATE, address VARCHAR(255), phone VARCHAR(25));
CREATE TABLE positions (id INT PRIMARY KEY, position VARCHAR(255));
CREATE TABLE staff_positions (id INT PRIMARY KEY, staff_id INT, position_id INT, start_date DATE, end_date DATE, FOREIGN KEY (staff_id) REFERENCES staffs(id), , FOREIGN KEY (position_id) REFERENCES positions(id));
 

-- 2 Write a raw query to select data for the following list


SELECT staff_positions.id, staffs.name, staffs.sex, staffs.date_of_birth, staffs.address, staffs.phone, positions.position  FROM staff_positions INNER JOIN positions on staff_positions.position_id=positions.id inner join staffs on staff_positions.staff_id=staffs.id;


-- 3 Write a raw query to select staff who have worked more than 5 years

SELECT staff_positions.id, staffs.name, staffs.sex, staffs.date_of_birth, staffs.address, staffs.phone, positions.position  FROM staff_positions INNER JOIN positions on staff_positions.position_id=positions.id inner join staffs on staff_positions.staff_id=staffs.id WHERE NOW() - staff_positions.start_date > 5;


