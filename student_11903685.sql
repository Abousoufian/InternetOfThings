-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `Data_Tabel`;
CREATE TABLE `Data_Tabel` (
  `ID` int(11) NOT NULL,
  `Value` decimal(10,0) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `ID` (`ID`),
  CONSTRAINT `Data_Tabel_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `Sensoren Tabel` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Data_Tabel` (`ID`, `Value`, `Time`) VALUES
(1,	0,	'2020-10-09 11:54:50');

DROP TABLE IF EXISTS `Sensoren Tabel`;
CREATE TABLE `Sensoren Tabel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL,
  `IP adress` varchar(64) NOT NULL,
  `Code` char(4) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Sensoren Tabel` (`ID`, `Name`, `IP adress`, `Code`, `Time`) VALUES
(1,	'Temperature',	'',	'T001',	'2020-10-09 11:53:32'),
(2,	'Humidity',	'',	'H001',	'2020-10-09 12:01:57');

-- 2020-10-11 15:36:57
