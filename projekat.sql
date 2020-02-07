/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.8-MariaDB : Database - itehprvidomaci
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`itehprvidomaci` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `itehprvidomaci`;

/*Table structure for table `clanak` */

DROP TABLE IF EXISTS `clanak`;

CREATE TABLE `clanak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tekst` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `korisnikId` int(11) DEFAULT NULL,
  `kategorijaId` int(11) DEFAULT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategorijaId` (`kategorijaId`),
  KEY `korisnikId` (`korisnikId`),
  CONSTRAINT `clanak_ibfk_2` FOREIGN KEY (`kategorijaId`) REFERENCES `kategorija` (`id`),
  CONSTRAINT `clanak_ibfk_3` FOREIGN KEY (`korisnikId`) REFERENCES `korisnik` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `clanak` */

insert  into `clanak`(`id`,`naslov`,`tekst`,`korisnikId`,`kategorijaId`,`slika`) values 
(5,'naslov 5','tekst5',3,1,'placeholder.jpg'),
(6,'naslov 6 updated','radi',1,3,'placeholder.jpg'),
(7,'naslov 7','tekst7',3,3,'placeholder.jpg'),
(8,'naslov 8','tekst8',2,2,'placeholder.jpg'),
(9,'naslov 9','tekst9',2,3,'placeholder.jpg'),
(13,'naslov neki normalan','tekst',3,1,'placeholder.jpg'),
(50,'Dodajem clanak','CLANAK IZMENJEN',1,3,'placeholder.jpg'),
(62,'Neki normalan naslov','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc sed augue lacus viverra vitae congue. Amet porttitor eget dolor morbi non arcu risus. Quam pellentesque nec nam aliquam sem et. Id volutpat lacus laoreet non curabitur gravida arcu. Viverra nibh cras pulvinar mattis nunc sed. Habitant morbi tristique senectus et netus et malesuada fames ac. Duis tristique sollicitudin nibh sit. Nullam non nisi est sit amet. Eu consequat ac felis donec. Urna duis convallis convallis tellus. Nisl tincidunt eget nullam non nisi est sit. Eu consequat ac felis donec. Morbi non arcu risus quis varius quam quisque id. Enim diam vulputate ut pharetra sit amet aliquam id. Et netus et malesuada fames ac turpis. Sit amet consectetur adipiscing elit ut aliquam purus sit amet. Ipsum a arcu cursus vitae congue mauris. Augue neque gravida in fermentum et sollicitudin ac.  Scelerisque in dictum non consectetur a erat nam at lectus. Enim sed faucibus turpis in eu mi bibendum. Orci eu lobortis elementum nibh tellus molestie nunc non. Lorem ipsum dolor sit amet consectetur adipiscing elit. Egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Curabitur vitae nunc sed velit dignissim sodales ut eu. Venenatis urna cursus eget nunc scelerisque viverra mauris. Tempus imperdiet nulla malesuada pellentesque elit eget. Semper eget duis at tellus at urna. Faucibus turpis in eu mi bibendum neque egestas. Imperdiet dui accumsan sit amet nulla facilisi. Aliquam malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Sed risus pretium quam vulputate dignissim suspendisse in est ante.  Erat pellentesque adipiscing commodo elit at imperdiet dui. Eget aliquet nibh praesent tristique magna. Hendrerit gravida rutrum quisque non tellus. Sed libero enim sed faucibus. Vitae congue mauris rhoncus aenean vel elit scelerisque mauris. Purus non enim praesent elementum facilisis leo vel. Fermentum odio eu feugiat pretium nibh ipsum consequat nisl vel. Nunc sed blandit libero volutpat sed cras ornare arcu. Hendrerit dolor magna eget est. Lorem dolor sed viverra ipsum nunc. Egestas sed sed risus pretium quam vulputate dignissim suspendisse. In nisl nisi scelerisque eu ultrices vitae.  Enim diam vulputate ut pharetra sit amet aliquam id diam. Leo in vitae turpis massa sed elementum tempus egestas. Nunc eget lorem dolor sed. In egestas erat imperdiet sed euismod. Aliquam etiam erat velit scelerisque in dictum non consectetur. Feugiat scelerisque varius morbi enim nunc faucibus a. Rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Viverra maecenas accumsan lacus vel. Mauris commodo quis imperdiet massa tincidunt nunc pulvinar sapien et. Vitae suscipit tellus mauris a diam maecenas sed enim ut. Eget nullam non nisi est. Enim ut sem viverra aliquet eget sit. Venenatis tellus in metus vulputate eu. Sit amet aliquam id diam. Arcu cursus vitae congue mauris. Donec pretium vulputate sapien nec sagittis aliquam malesuada bibendum arcu. Ut etiam sit amet nisl purus in mollis nunc sed. Dis parturient montes nascetur ridiculus. Tortor pretium viverra suspendisse potenti.  Imperdiet sed euismod nisi porta lorem. Tellus in metus vulputate eu scelerisque felis imperdiet proin fermentum. Penatibus et magnis dis parturient montes nascetur ridiculus mus. Ut faucibus pulvinar elementum integer enim neque volutpat. Nulla facilisi cras fermentum odio. Sed arcu non odio euismod lacinia at quis risus. Mollis aliquam ut porttitor leo a diam. Duis ultricies lacus sed turpis tincidunt id aliquet risus. Neque volutpat ac tincidunt vitae. Id donec ultrices tincidunt arcu non sodales neque.',1,3,'placeholder.jpg'),
(75,'moda moda','stvarno moda updated',1,8,'placeholder.jpg'),
(76,'estrada proba 1','egoerioooooooooooooooo',3,9,'placeholder.jpg'),
(77,'proba estrada 2','fddfghfffg',3,9,'placeholder.jpg'),
(78,'drustvojedan','fdfdsgdfgdg',1,3,'placeholder.jpg'),
(79,'drustvo2','sfsdgsfdg',1,3,'placeholder.jpg'),
(80,'15.','15.',1,8,'placeholder.jpg'),
(81,'ggg','test slike',1,1,'placeholder.jpg'),
(82,'fddsfds','fdfdfds',1,9,'placeholder.jpg'),
(83,'test3 slika','ddwd',1,9,'placeholder.jpg'),
(84,'fdfdsf','fdsfdsf',1,8,'placeholder.jpg'),
(85,'testposle','fdff',1,5,'placeholder.jpg'),
(86,'dfdfdfd','dfdsfdf',1,5,'placeholder.jpg'),
(87,'slikaprobaubazi','dsfdf',1,5,'placeholder.jpg'),
(88,'slika u bazi fin','al',1,1,'placeholder.jpg'),
(89,'clanak za upload','slike',1,5,'placeholder.jpg'),
(90,'za upload slike 2','dsdf',1,4,'placeholder.jpg'),
(91,'sdsdsdsdsdsd','dsddsds',1,5,'placeholder.jpg'),
(92,'dff','dfdf',1,4,'placeholder.jpg'),
(94,'fdfdsfd','dfdsfdsf',1,2,'placeholder.jpg'),
(95,'dfdfd','fdsfd',1,1,'placeholder.jpg'),
(96,'dsdsd','sadsad',1,1,'placeholder.jpg'),
(97,'dfd','dfdfd',1,1,'placeholder.jpg'),
(98,'dsdsds','sdsdasd',1,1,'placeholder.jpg'),
(99,'dfdfd','dsfdf',1,4,'placeholder.jpg'),
(100,'dfdfd','dfdsf',1,7,'placeholder.jpg'),
(101,'dsds','sdsd',1,9,'placeholder.jpg'),
(102,'dsdd','sdd',1,1,'placeholder.jpg'),
(103,'nemam pojma','vise',1,9,'placeholder.jpg'),
(104,'df','df',1,1,'placeholder.jpg'),
(105,'fdfd','dffsd',1,8,'placeholder.jpg'),
(116,'post naslov','proba proba test postman',1,3,'placeholder.jpg'),
(117,'post naslov postman','proba proba test postman 2',1,4,'placeholder.jpg'),
(120,'NASLOV IZ POSTMANA','proba proba test postman 3',1,3,'placeholder2.jpg'),
(122,'Proba','gdfgdfgfgdfgf',1,9,'placeholder3.jpg'),
(124,'test poziv ws-a','dsfsdfsd',1,7,'placeholder4.jpg');

/*Table structure for table `kategorija` */

DROP TABLE IF EXISTS `kategorija`;

CREATE TABLE `kategorija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `kategorija` */

insert  into `kategorija`(`id`,`naziv`) values 
(1,'IT'),
(2,'Ekonomija'),
(3,'Društvo'),
(4,'Sport'),
(5,'Zabava'),
(7,'Crna hronika'),
(8,'Moda'),
(9,'Estrada');

/*Table structure for table `korisnik` */

DROP TABLE IF EXISTS `korisnik`;

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ulogaID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ulogaID` (`ulogaID`),
  CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`ulogaID`) REFERENCES `uloga` (`ulogaID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `korisnik` */

insert  into `korisnik`(`id`,`username`,`password`,`ulogaID`) values 
(1,'dalibor','60df06547ca615835b12e2a30e741961a34f6ba005f41b68929be8683433d43a',1),
(2,'nekidrugi','25862b1b6ca0ee21d472a8529a6ab06e1afa5b40a73bf3cedea4a4afdcd63ad7',2),
(3,'korisnik3','a73f3a1e3276df704faf09b6f65c34845ac7f5243c1f427f18310eafd0b1ef25',2),
(4,'korisnik5','4b4b6e82f36e3f90d60d95f22da621110e89bd8234372f25bbd096a8696c1876',2),
(9,'korisnik6','040b6b205b811a4e2d8acf90267c43f7fa07581de94f276b4ccca55abb4cb32c',2),
(10,'admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',1),
(12,'korisnik7','783cbca46d1eb025350938e10b325323f91b1c8d50eeb00ec8a51418f7362bab',2),
(13,'korisnik8','91b972779e4f0eeeaba080b901c8c669ed89f7f0e84b41d48d5510f83e5dac0a',2),
(14,'autor','3ae92cf0ef4237e0c4eb512dd1fd17831d0c2316926ddea711afe520a0e5027a',2),
(15,'user','04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb',2),
(16,'korisnikfinal','5cd0186c4883965932cc05d98db6120da71143070df2e01c66cd0493deb9fdac',2),
(17,'autor2','8e6928fbc9f74db5a71efab30b1d4e3dd0ae22b7eb9a3dec87a897011e52dd0e',2);

/*Table structure for table `uloga` */

DROP TABLE IF EXISTS `uloga`;

CREATE TABLE `uloga` (
  `ulogaID` int(11) NOT NULL,
  `nazivUloge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ulogaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `uloga` */

insert  into `uloga`(`ulogaID`,`nazivUloge`) values 
(1,'admin'),
(2,'autor');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
