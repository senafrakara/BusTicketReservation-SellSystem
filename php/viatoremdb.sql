-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 15 Oca 2020, 20:27:17
-- Sunucu sürümü: 5.7.26
-- PHP Sürümü: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `viatoremdb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `CreditCardNumber` int(15) NOT NULL,
  `Balance` double NOT NULL,
  PRIMARY KEY (`CreditCardNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `bank`
--

INSERT INTO `bank` (`CreditCardNumber`, `Balance`) VALUES
(2152285, 9722.5),
(123456789, 1575),
(456123789, -97.5),
(789123456, 2500),
(987654321, 1677.5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `campaign`
--

DROP TABLE IF EXISTS `campaign`;
CREATE TABLE IF NOT EXISTS `campaign` (
  `CampaignID` int(11) NOT NULL AUTO_INCREMENT,
  `Content` text,
  PRIMARY KEY (`CampaignID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `campaign`
--

INSERT INTO `campaign` (`CampaignID`, `Content`) VALUES
(1, '% 5 Discount at all tickets'),
(4, '%10 discount at all tickets.'),
(5, '%15 discount at all tickets.'),
(6, '%20 discount at all tickets'),
(7, '% 25 discount at all tickets.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `FeedbackID` int(255) NOT NULL AUTO_INCREMENT,
  `emaill` varchar(55) NOT NULL,
  `Content` text,
  `isApproved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`FeedbackID`),
  KEY `fk5` (`emaill`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `MessageID` int(255) NOT NULL AUTO_INCREMENT,
  `Content` varchar(140) NOT NULL,
  `FromEmaill` varchar(55) DEFAULT NULL,
  `ToEmaill` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`MessageID`),
  KEY `fk7` (`FromEmaill`),
  KEY `fk8` (`ToEmaill`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `message`
--

INSERT INTO `message` (`MessageID`, `Content`, `FromEmaill`, `ToEmaill`) VALUES
(4, 'Your service is awesome!', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(5, 'Your service is awesome', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(23, 'Your site is perfect!', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(24, 'Hello nursena bla ', 'berkegulec@hotmail.com', 'senafrakara@gmail.com'),
(25, 'xsaderft5y67u89', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(26, 'SDFGTHYUJKL', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(27, 'Hello officer,', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(28, 'hello ı am fatih', 'fatihgulec@gmail.com', 'berkegulec@hotmail.com'),
(29, 'hello i am fatih', 'fatihgulec@gmail.com', 'berkegulec@hotmail.com'),
(30, 'hello i am nursena i am very happy', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(31, 'hello sdfg', 'fatihgulec@gmail.com', 'berkegulec@hotmail.com'),
(32, 'I have some problem about my ticket', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(33, 'I want to cancel my ticket but the system gives me wqsedrfgtj', 'elifesilaoflz@gmail.com', 'berkegulec@hotmail.com'),
(34, 'It s done.', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(35, 'Message is done', 'senafrakara@gmail.com', 'berkegulec@hotmail.com'),
(37, 'Message is already done', 'senafrakara@gmail.com', 'berkegulec@hotmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `ReservationID` int(255) NOT NULL AUTO_INCREMENT,
  `TripID` int(255) DEFAULT NULL,
  `emaillUser` varchar(55) DEFAULT NULL,
  `SeatID` int(70) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `emaillOwner` varchar(55) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `isCancelled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ReservationID`),
  KEY `fk1` (`TripID`),
  KEY `fk2` (`emaillUser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `TripID` int(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `emaillOwner` varchar(55) NOT NULL,
  `emaillUser` varchar(55) DEFAULT NULL,
  `isCancelled` tinyint(1) DEFAULT '0',
  `PNR` int(255) NOT NULL AUTO_INCREMENT,
  `SeatID` int(70) NOT NULL,
  `gender` varchar(1) NOT NULL,
  PRIMARY KEY (`PNR`),
  KEY `fk3` (`TripID`),
  KEY `fk4` (`emaillUser`)
) ENGINE=InnoDB AUTO_INCREMENT=123456816 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ticket`
--

INSERT INTO `ticket` (`TripID`, `name`, `surname`, `emaillOwner`, `emaillUser`, `isCancelled`, `PNR`, `SeatID`, `gender`) VALUES
(2, 'Ahmet', 'Mehmet', 'abcdf@gmail.com', NULL, 0, 456123, 18, 'M'),
(3, 'Nursena', 'Karakulah', 'senafrakara@gmail.com', 'senafrakara@gmail.com', 0, 789456, 15, 'F'),
(5, 'DENİZ SE', 'DRFGTHYJU', 'senafrakara@gmail.com', 'senafrakara@gmail.com', 1, 11111111, 8, 'F'),
(2, 'Berke ', 'Güleç', 'senafrakara@gmail.com', 'senafrakara@gmail.com', 1, 123456789, 5, 'M'),
(5, 'eren', 'kural', 'senafrakara@gmail.com', 'senafrakara@gmail.com', 1, 123456790, 1, 'M'),
(5, 'Şura', 'Karakulah', 'suranur@gmail.com', 'senafrakara@gmail.com', 0, 123456794, 2, 'F'),
(9, 'Elif ', 'Oflaz', 'elifesiloflz@gmail.com', 'senafrakara@gmail.com', 0, 123456795, 1, 'F'),
(2, 'Nursena', 'Karakulah', 'senafrakara@gmail.com', 'senafrakara@gmail.com', 0, 123456796, 6, 'F'),
(9, 'Erhan', 'Oflaz', 'e4rhanoflaz@gmail.com', 'senafrakara@gmail.com', 0, 123456797, 2, 'M'),
(9, 'hilal', 'oflaz', 'hilaloflaz@gmail.com', 'senafrakara@gmail.com', 0, 123456798, 3, 'F'),
(9, 'Esra', 'Zelleci', 'esrazelleci@gmail.com', 'senafrakara@gmail.com', 0, 123456799, 4, 'F'),
(9, 'Ayşe', 'Fatma', 'abcddf@gmail.com', NULL, 0, 123456800, 5, 'F'),
(10, 'Nursena', 'Karakulah', 'senafrakara@gmail.com', 'senafrakara@gmail.com', 0, 123456801, 1, 'F'),
(10, 'Berke', 'Gulec', 'runjeberke@gmail.com', 'senafrakara@gmail.com', 0, 123456802, 2, 'M'),
(10, 'Nurihda', 'Karakulah', 'nurihda@gmail.com', 'senafrakara@gmail.com', 0, 123456805, 3, 'F'),
(10, 'Kubra', 'Felek', 'kubraflk@gmail.com', 'denizcaliskan@gmail.com', 0, 123456806, 5, 'F'),
(10, 'Eren', 'Duman', 'eren@gmail.com', NULL, 0, 123456807, 4, 'M'),
(10, 'Deniz', 'Çalışkan', 'deniz.caliskan@isik.edu.tr', 'deniz.caliskan@isik.edu.tr', 0, 123456808, 6, 'M'),
(10, 'Deniz', 'Çalışkan', 'deniz.caliskan@isik.edu.tr', NULL, 0, 123456809, 7, 'M'),
(10, 'Deniz', 'Çalışkan', 'deniz.caliskan@isik.edu.tr', 'deniz.caliskan@isik.edu.tr', 0, 123456810, 8, 'M'),
(13, 'Nursena', 'Karakulah', 'senafrakara@gmail.com', 'senafrakara@gmail.com', 0, 123456811, 1, 'F'),
(13, 'Nursena', 'Karakulah', 'senafrakara@gmail.com', 'senafrakara@gmail.com', 0, 123456812, 2, 'F'),
(15, 'Nursena', 'Karakulah', 'senafrakara@gmail.com', 'senafrakara@gmail.com', 0, 123456813, 30, 'F'),
(15, 'Berke', 'Güleç', 'berke.gulec@gmail.com', 'senafrakara@gmail.com', 0, 123456814, 15, 'M'),
(15, 'Berre', 'Güleç', 'berre@gmail.com', 'senafrakara@gmail.com', 0, 123456815, 16, 'F');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `trip`
--

DROP TABLE IF EXISTS `trip`;
CREATE TABLE IF NOT EXISTS `trip` (
  `TripID` int(255) NOT NULL AUTO_INCREMENT,
  `StartLocation` varchar(20) NOT NULL,
  `EndLocation` varchar(20) NOT NULL,
  `TripDate` date NOT NULL,
  `TripTime` time NOT NULL,
  `Price` double NOT NULL,
  `Capacity` int(55) NOT NULL DEFAULT '30',
  `CampaignID` int(11) NOT NULL,
  `isCancelled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`TripID`),
  KEY `fk9` (`CampaignID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `trip`
--

INSERT INTO `trip` (`TripID`, `StartLocation`, `EndLocation`, `TripDate`, `TripTime`, `Price`, `Capacity`, `CampaignID`, `isCancelled`) VALUES
(2, 'Istanbul', 'Ankara', '2020-01-07', '17:30:00', 150, 30, 5, 0),
(3, 'Istanbul', 'Eskisehir', '2019-11-05', '14:00:00', 100, 50, 5, 0),
(4, 'istanbul', 'kütahya', '2019-12-18', '19:00:00', 55, 50, 5, 0),
(5, 'istanbul', 'kütahya', '2020-01-02', '20:00:00', 65, 30, 5, 0),
(6, 'istanbul', 'kütahya', '2019-12-18', '21:00:00', 65, 50, 5, 1),
(7, 'istanbul', 'kütahya', '2019-12-19', '19:00:00', 55, 50, 5, 0),
(8, 'Istanbul', 'Ankara', '2019-12-16', '23:00:00', 75, 50, 5, 0),
(9, 'Istanbul', 'erzincan', '2020-01-05', '15:00:00', 140, 50, 5, 0),
(10, 'Ankara', 'Istanbul', '2020-01-05', '13:00:00', 150, 30, 5, 0),
(11, 'Ankara', 'Istanbul', '2020-01-05', '15:00:00', 150, 30, 5, 0),
(12, 'Ankara', 'Istanbul', '2020-01-05', '18:00:00', 150, 30, 5, 0),
(13, 'İstanbul', 'Konya', '2020-01-24', '15:00:00', 150, 30, 5, 0),
(14, 'İstanbul', 'Konya', '2020-01-24', '15:00:00', 150, 30, 5, 1),
(15, 'İstanbul', 'Konya', '2020-01-24', '16:00:00', 150, 30, 5, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `emaill` varchar(55) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `name` tinytext NOT NULL,
  `surname` tinytext NOT NULL,
  `userType` varchar(10) DEFAULT NULL,
  `birtDate` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `Question` varchar(10) NOT NULL,
  `AnswerToQuestion` varchar(25) NOT NULL,
  PRIMARY KEY (`emaill`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`emaill`, `pwd`, `name`, `surname`, `userType`, `birtDate`, `gender`, `phoneNumber`, `Question`, `AnswerToQuestion`) VALUES
('admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'Admin', 'Admin', 'admin', NULL, NULL, NULL, 'question1', 'banana'),
('aysegul@gmail.com', '90d64b8b40f3d4658dcdf676d67ac3c8', 'Ayşegül', 'Yılmaz', 'registered', '1982-07-23', 'F', '05361456978', 'question3', 'c'),
('berkaydanis@hotmail.com', '30925d108492e177e0b90f416bdc44eb', 'Berkay', 'Danış', 'registered', '1996-02-07', 'M', '054516841648', 'question3', 'b'),
('berkegulec@hotmail.com', 'e4ee7e2a44a75d80f5516178a5b441b9', 'Berke', 'Gulec', 'officer', NULL, 'M', '05415648464', 'question1', 'apple'),
('berre@gmail.com', '23852fc232e8c9fa09589f94a7b244ac', 'Berre', 'Gulec', 'registered', '1979-11-20', 'F', '05412314562', 'question1', 'orange'),
('caferkrklh@gmail.com', '03177495669aac757798f3071a1cc737', 'Cafer', 'Krklh', 'registered', '1981-06-09', 'M', '05451235645', 'question5', 'black'),
('deniz.caliskan@isik.edu.tr', '202cb962ac59075b964b07152d234b70', 'Deniz', 'Çalışkan', 'registered', '1997-06-26', 'M', '05070528098', 'question1', 'mandarin'),
('deniz@gmail.com', '5844c3ea8e0985fb6ec0604f5b45e55d', 'Deniz ', 'Yelmen', 'registered', '1987-11-12', 'F', '0545613165', 'question4', 'cauliflower'),
('denizcaliskan@gmail.com', '80ab27a55630dd3e750756e8667967ef', 'Deniz', 'Caliskan', 'registered', '1996-12-12', 'M', '05352369878', 'question1', 'apple'),
('elifesilaoflz@gmail.com', '71343a93b35411b562171817d8289802', 'Esila', 'Oflaz', 'registered', '1998-09-16', 'F', '05369972862', 'question1', 'nektari'),
('emine@gmail.com', '3285bba8a46299c559ed89bc10f00d25', 'Emine', 'Kahriman', 'registered', '1997-12-18', 'F', '0541346795', 'question5', 'green'),
('emineyldz@outlook.com', 'fee17c4928c1dd0740315d6bb6d8974d', 'Emine', 'Yıldız', 'registered', '1976-12-17', 'F', '05423659166', 'question5', 'black'),
('fatihgulec@gmail.com', 'e821a8bfc2c786f275e5d5ea94d519a7', 'Fatih', 'Güleç', 'registered', '1979-12-03', 'M', '05423697482', 'question2', 'mehmet'),
('john@gmail.com', '6e0b7076126a29d5dfcbd54835387b7b', 'John', 'Black', 'registered', '1968-12-04', 'M', '0123-456-7889', 'question5', 'red'),
('kubraflk@gmail.com', '8040cb2261700ffd3057a6fcbd3942ff', 'Kübra', 'Felek', 'registered', '1998-01-01', 'F', '05415648464', 'question2', 'huseyin'),
('mstfyldz@gmail.com', 'e5de81655caaea1616f2d5afe6cb3d23', 'Mustafa', 'Yıldız', 'registered', '1980-11-12', 'M', '05414368598', 'question5', 'yellow'),
('nuray@outlook.com', '5ecd7ccd8d9d7cf5f5cd96394251d368', 'Nuray', 'Girgin', 'registered', '1940-12-18', 'F', '1234567889', 'question3', 'i'),
('nursenakara@gmail.com', '63c3e05b919051da09efe9fd37c24051', 'Nursena', 'Karakulah', 'registered', '1998-07-01', 'F', '05436897425', 'question2', 'ayse'),
('senafra@gmail.com', '11697ac6cae30582735e2132ebf1b70e', 'Afra', 'Kara', 'registered', '1998-07-01', 'F', '05415648464', 'question3', 'c'),
('senafrakara@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Nursena', 'Karakulah', 'registered', '1999-11-05', 'F', '05414363683', 'question5', 'purple');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk5` FOREIGN KEY (`emaill`) REFERENCES `users` (`emaill`);

--
-- Tablo kısıtlamaları `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk7` FOREIGN KEY (`FromEmaill`) REFERENCES `users` (`emaill`),
  ADD CONSTRAINT `fk8` FOREIGN KEY (`ToEmaill`) REFERENCES `users` (`emaill`);

--
-- Tablo kısıtlamaları `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`TripID`) REFERENCES `trip` (`TripID`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`emaillUser`) REFERENCES `users` (`emaill`);

--
-- Tablo kısıtlamaları `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`TripID`) REFERENCES `trip` (`TripID`),
  ADD CONSTRAINT `fk4` FOREIGN KEY (`emaillUser`) REFERENCES `users` (`emaill`);

--
-- Tablo kısıtlamaları `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `fk9` FOREIGN KEY (`CampaignID`) REFERENCES `campaign` (`CampaignID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
