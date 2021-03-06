SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `zapisi` (
`idZapisi` int(11) NOT NULL,
  `Leto` date NOT NULL,
  `Razdalja` float NOT NULL,
  `Cas` time NOT NULL,
  `PovpHitrost` float NOT NULL,
  `MaxHitrost` float NOT NULL,
  `MinTemp` float NOT NULL,
  `MaxTemp` int(11) NOT NULL,
  `Kalorije` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


ALTER TABLE `zapisi`
 ADD PRIMARY KEY (`idZapisi`), ADD UNIQUE KEY `Leto` (`Leto`);


ALTER TABLE `zapisi`
MODIFY `idZapisi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
