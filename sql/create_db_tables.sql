#######################################################
######### Создание базы данных persona_php ############
DROP DATABASE IF EXISTS persona_php;
CREATE DATABASE IF NOT EXISTS persona_php CHARACTER SET utf8;
USE persona_php;

#######################################################
################## Создание таблиц ####################

############## Таблица users с пользователями ###############
DROP TABLE IF EXISTS users;

CREATE TABLE users(
	users_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(30) NOT NULL,
	password CHAR(40) NOT NULL,
	sys_date DATETIME NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

######### Добавление пользователя 'admin' в таблицу users ##########
-- Пароль для 'admin' = '111'
INSERT INTO users (users_id, login, password, sys_date)
VALUES (NULL, 'admin', '21246f09ac7c46c76271dba7f9fe98e154fd2994', NOW());

############## Таблица persons с лицами ###############
DROP TABLE IF EXISTS persons;

CREATE TABLE persons(
	persons_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	sur VARCHAR(50),
	name_lat VARCHAR(50),
	sur_lat VARCHAR(50),
	birth DATE,
	civil VARCHAR(100),
	passport VARCHAR(30),
	number_pers VARCHAR(30),
	number_auto VARCHAR(15),
	sys_date DATETIME NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

############## Таблица info_fab с информацией о задержании ###############
DROP TABLE IF EXISTS info_fab;

CREATE TABLE info_fab(
	persons_id INT UNSIGNED NOT NULL REFERENCES persons(persons_id),
	date_info DATE,
	country VARCHAR(10),
	direction CHAR(5) NOT NULL,
	ppr VARCHAR(100),
	who VARCHAR(100),
	fab TEXT,
	sys_date DATETIME NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

############## Таблица tmc с информацией о ТМЦ ###############
DROP TABLE IF EXISTS tmc;

CREATE TABLE tmc(
	persons_id INT UNSIGNED NOT NULL REFERENCES persons(persons_id),
	sort VARCHAR(100),
	quant_sel VARCHAR(20),
	quant BIGINT,
	price_sel VARCHAR(30),
	price BIGINT,
	sys_date DATETIME NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

############## Таблица logs с логами ###############
DROP TABLE IF EXISTS logs;

CREATE TABLE logs(
	logs_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(30) NOT NULL,
	event VARCHAR(50) NOT NULL,
	sys_date DATETIME NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#######################################################
################## Создание индексов ##################
CREATE INDEX index_login ON users(login);

CREATE INDEX index_sur ON persons(sur);
CREATE INDEX index_sur_lat ON persons(sur_lat);
CREATE INDEX index_number_pers ON persons(number_pers);
CREATE INDEX index_number_auto ON persons(number_auto);

CREATE INDEX index_date_info ON info_fab(date_info);
CREATE INDEX index_direction ON info_fab(direction);
CREATE INDEX index_ppr ON info_fab(ppr);
CREATE FULLTEXT INDEX index_fab ON info_fab(fab);

#######################################################
################# Создание триггеров ##################
##### DROP TRIGGER users_ai;
CREATE TRIGGER users_ai
AFTER INSERT ON users
FOR EACH ROW
INSERT INTO logs (logs_id, login, event, sys_date)
VALUES (NULL, CURRENT_USER(), 'ADDED user in table users', NOW());

##### DROP TRIGGER users_au;
CREATE TRIGGER users_au
AFTER UPDATE ON users
FOR EACH ROW
INSERT INTO logs (logs_id, login, event, sys_date)
VALUES (NULL, CURRENT_USER(), 'UPDATED user in table users', NOW());

##### DROP TRIGGER users_ad;
CREATE TRIGGER users_ad
AFTER DELETE ON users
FOR EACH ROW
INSERT INTO logs (logs_id, login, event, sys_date)
VALUES (NULL, CURRENT_USER(), 'DELETED user from table users', NOW());


##### DROP TRIGGER persons_ai;
CREATE TRIGGER persons_ai
AFTER INSERT ON persons
FOR EACH ROW
INSERT INTO logs (logs_id, login, event, sys_date)
VALUES (NULL, CURRENT_USER(), 'ADDED record in table persons', NOW());

##### DROP TRIGGER persons_au;
CREATE TRIGGER persons_au
AFTER UPDATE ON persons
FOR EACH ROW
INSERT INTO logs (logs_id, login, event, sys_date)
VALUES (NULL, CURRENT_USER(), 'UPDATED record in table persons', NOW());

##### DROP TRIGGER persons_ad;
CREATE TRIGGER persons_ad
AFTER DELETE ON persons
FOR EACH ROW
INSERT INTO logs (logs_id, login, event, sys_date)
VALUES (NULL, CURRENT_USER(), 'DELETED record from table persons', NOW());