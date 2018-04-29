-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2018 at 03:00 PM
-- Server version: 5.5.54-0+deb8u1
-- PHP Version: 5.6.29-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zakhavan`
--

-- --------------------------------------------------------

--
-- Table structure for table `Addresses`
--

CREATE TABLE IF NOT EXISTS `Addresses` (
`AddressID` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `Address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Addresses`
--

INSERT INTO `Addresses` (`AddressID`, `customer_id`, `Address`) VALUES
(3, 1, 'jkwhr ksrn'),
(4, 1, 'Test address'),
(5, 2, 'jkwhr ksrn');

-- --------------------------------------------------------

--
-- Table structure for table `Carts`
--

CREATE TABLE IF NOT EXISTS `Carts` (
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Carts`
--

INSERT INTO `Carts` (`member_id`, `product_id`, `Quantity`) VALUES
(1, 4, 1),
(1, 8, 1),
(1, 11, 2),
(1127, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `OrderProducts`
--

CREATE TABLE IF NOT EXISTS `OrderProducts` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `OrderProducts`
--

INSERT INTO `OrderProducts` (`order_id`, `product_id`, `Quantity`) VALUES
(3, 3, 1),
(4, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE IF NOT EXISTS `Orders` (
`OrderID` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `Date_Time` datetime DEFAULT NULL,
  `TotalCost` decimal(5,2) DEFAULT NULL,
  `Status` enum('Placed','Confirmed','Canceled','Shipped','Delivered') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`OrderID`, `customer_id`, `address_id`, `Date_Time`, `TotalCost`, `Status`) VALUES
(1, 2, 5, '2018-04-29 14:56:28', 192.00, 'Placed'),
(2, 2, 5, '2018-04-29 14:57:48', 192.00, 'Placed'),
(3, 2, 5, '2018-04-29 14:58:37', 143.00, 'Placed'),
(4, 2, 5, '2018-04-29 14:59:09', 143.00, 'Placed');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
  `supplier_id` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `ProductType` varchar(20) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `Stock` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`supplier_id`, `ProductID`, `ProductType`, `ProductName`, `Description`, `Stock`, `Price`) VALUES
(1, 2, 'Shoes', 'eget,', 'convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenati', 26, 49),
(2, 3, 'Electronics', 'Aenean euismod', 'ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. C', 3, 143),
(4, 4, 'Computers', 'lobortis ultrices.', 'interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus. Nullam suscipi', 81, 82),
(4, 5, 'Health', 'lacus', 'mauris. Suspendisse aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis feli', 0, 20),
(3, 6, 'Outdoors', 'iaculis quis,', 'id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridicul', 14, 98),
(3, 7, 'Automotive', 'risus. Donec', 'Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus.', 64, 100),
(2, 8, 'Automotive', 'placerat', 'amet, risus. Donec nibh enim, gravida sit amet, dapibus id, blandit at, nisi. Cum sociis natoque pen', 16, 102),
(1, 9, 'Home', 'quis turpis', 'Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. D', 28, 124),
(4, 10, 'Home', 'libero. Integer in', 'ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla, porttitor v', 50, 108),
(3, 11, 'Clothing', 'Aliquam fringilla cursus', 'in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque orna', 26, 12),
(3, 12, 'Health', 'tortor at', 'Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tinci', 13, 57),
(2, 13, 'Electronics', 'neque pellentesque massa', 'volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, r', 56, 25),
(1, 14, 'Home', 'dapibus rutrum, justo.', 'lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vi', 85, 72),
(1, 15, 'Automotive', 'commodo at, libero.', 'sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis', 43, 62),
(3, 16, 'Home', 'congue', 'Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspen', 29, 80),
(1, 17, 'Computers', 'ipsum primis', 'eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien', 64, 46),
(3, 18, 'Computers', 'Quisque porttitor', 'nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascet', 39, 84),
(2, 19, 'Automotive', 'facilisis.', 'Aliquam erat volutpat. Nulla dignissim. Maecenas ornare egestas ligula. Nullam feugiat placerat veli', 46, 80),
(1, 20, 'Clothing', 'tincidunt', 'tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fam', 57, 57),
(3, 21, 'Jewelery', 'consectetuer adipiscing', 'ac turpis egestas. Aliquam fringilla cursus purus. Nullam scelerisque neque sed sem egestas blandit.', 59, 103),
(3, 22, 'Health', 'magna et ipsum', 'eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulv', 35, 122),
(3, 23, 'Shoes', 'ut', 'eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutr', 62, 30),
(2, 24, 'Electronics', 'tellus. Nunc', 'dui quis accumsan convallis, ante lectus convallis est, vitae sodales nisi magna sed dui. Fusce aliq', 23, 24),
(4, 25, 'Jewelery', 'eget massa. Suspendisse', 'vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat', 19, 140),
(4, 26, 'Health', 'Duis', 'malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempo', 24, 114),
(3, 27, 'Home', 'et libero.', 'parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac lib', 26, 93),
(2, 28, 'Clothing', 'eu, ultrices sit', 'quis, pede. Suspendisse dui. Fusce diam nunc, ullamcorper eu, euismod ac, fermentum vel, mauris. Int', 14, 16),
(3, 29, 'Shoes', 'ornare.', 'dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa.', 30, 147),
(3, 30, 'Outdoors', 'sem semper', 'nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula cons', 89, 65),
(3, 31, 'Computers', 'risus. Morbi', 'egestas. Aliquam fringilla cursus purus. Nullam scelerisque neque sed sem egestas blandit. Nam nulla', 73, 98),
(1, 32, 'Shoes', 'dolor. Fusce', 'fermentum vel, mauris. Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu. Sed et libero', 82, 77),
(2, 33, 'Outdoors', 'risus. Donec', 'Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo e', 43, 109),
(1, 34, 'Home', 'Sed', 'Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla', 49, 59),
(3, 35, 'Outdoors', 'Quisque', 'et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et', 24, 25),
(1, 36, 'Electronics', 'lorem, auctor', 'risus odio, auctor vitae, aliquet nec, imperdiet nec, leo. Morbi neque tellus, imperdiet non, vestib', 26, 107),
(4, 37, 'Outdoors', 'Suspendisse', 'Sed et libero. Proin mi. Aliquam gravida mauris ut mi. Duis risus odio, auctor vitae, aliquet nec, i', 35, 70),
(3, 38, 'Outdoors', 'per inceptos', 'gravida. Praesent eu nulla at sem molestie sodales. Mauris blandit enim consequat purus. Maecenas li', 51, 117),
(1, 39, 'Computers', 'quis massa.', 'non enim. Mauris quis turpis vitae purus gravida sagittis. Duis gravida. Praesent eu nulla at sem mo', 18, 110),
(1, 40, 'Automotive', 'consequat dolor', 'orci luctus et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit amet diam eu', 3, 20),
(1, 41, 'Shoes', 'mi enim,', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris u', 75, 78),
(3, 42, 'Automotive', 'et tristique pellentesque,', 'penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel nisl. Quisque fringilla', 10, 56),
(1, 43, 'Computers', 'amet diam', 'vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iacul', 87, 149),
(4, 44, 'Home', 'arcu. Curabitur', 'non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, molli', 73, 91),
(2, 45, 'Outdoors', 'facilisis facilisis,', 'libero nec ligula consectetuer rhoncus. Nullam velit dui, semper et, lacinia vitae, sodales at, veli', 42, 31),
(3, 46, 'Clothing', 'faucibus. Morbi vehicula.', 'scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis', 58, 73),
(1, 47, 'Outdoors', 'felis eget varius', 'taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut quam vel sa', 43, 47),
(4, 48, 'Clothing', 'libero. Donec', 'Duis gravida. Praesent eu nulla at sem molestie sodales. Mauris blandit enim consequat purus. Maecen', 84, 106),
(2, 49, 'Health', 'porttitor', 'Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. ', 32, 53),
(2, 50, 'Computers', 'bibendum', 'velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, augue. Sed molestie. Sed id ', 91, 129),
(4, 51, 'Electronics', 'mi', 'Morbi accumsan laoreet ipsum. Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper', 3, 99),
(2, 52, 'Outdoors', 'Integer aliquam', 'ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Qui', 4, 32),
(3, 53, 'Clothing', 'Nunc', 'odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa. Integer vitae nibh. Donec est mau', 33, 40),
(2, 54, 'Health', 'accumsan sed, facilisis', 'faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at, ', 3, 125),
(4, 55, 'Jewelery', 'Proin eget', 'ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna', 49, 137),
(1, 56, 'Computers', 'lorem', 'ut, sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellu', 89, 29),
(4, 57, 'Outdoors', 'tortor nibh sit', 'egestas rhoncus. Proin nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem, l', 65, 128),
(4, 58, 'Clothing', 'elit. Etiam', 'Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In scelerisque scelerisque dui. Su', 1, 16),
(2, 59, 'Health', 'blandit viverra. Donec', 'sit amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa', 69, 17),
(2, 60, 'Home', 'mollis. Duis sit', 'diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. ', 87, 45),
(2, 61, 'Electronics', 'Cum sociis', 'eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulv', 44, 131),
(1, 62, 'Clothing', 'sit amet', 'nisi magna sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molest', 56, 46),
(3, 63, 'Automotive', 'Etiam vestibulum massa', 'non quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egest', 45, 146),
(3, 64, 'Automotive', 'id, erat. Etiam', 'Ut tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at,', 79, 66),
(1, 65, 'Outdoors', 'sed, est.', 'sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus ', 18, 118),
(4, 66, 'Computers', 'et', 'mollis vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum placerat, au', 2, 120),
(3, 67, 'Health', 'tortor. Nunc commodo', 'Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor ', 83, 141),
(4, 68, 'Shoes', 'scelerisque, lorem', 'vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat', 93, 122),
(3, 69, 'Jewelery', 'eu, accumsan', 'Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus', 51, 49),
(2, 70, 'Home', 'scelerisque', 'Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices pos', 61, 91),
(1, 71, 'Outdoors', 'Integer aliquam adipiscing', 'nec luctus felis purus ac tellus. Suspendisse sed dolor. Fusce mi lorem, vehicula et, rutrum eu, ult', 65, 90),
(2, 72, 'Computers', 'dui nec urna', 'eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, l', 97, 32),
(2, 73, 'Outdoors', 'Pellentesque', 'orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac n', 79, 61),
(2, 74, 'Outdoors', 'nec orci. Donec', 'purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet moles', 89, 44),
(2, 75, 'Jewelery', 'quis', 'scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasel', 11, 69),
(1, 76, 'Computers', 'magna.', 'vitae risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonumm', 96, 114),
(4, 77, 'Shoes', 'tincidunt', 'arcu. Sed et libero. Proin mi. Aliquam gravida mauris ut mi. Duis risus odio, auctor vitae, aliquet ', 18, 120),
(4, 78, 'Electronics', 'venenatis lacus. Etiam', 'per inceptos hymenaeos. Mauris ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pel', 16, 75),
(3, 79, 'Health', 'Morbi vehicula.', 'at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proi', 35, 145),
(1, 80, 'Health', 'lacinia at,', 'sed dui. Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor n', 88, 105),
(1, 81, 'Outdoors', 'Integer mollis. Integer', 'vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu', 63, 33),
(1, 82, 'Computers', 'turpis', 'eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutr', 54, 53),
(3, 83, 'Home', 'eget nisi dictum', 'amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec', 84, 104),
(1, 84, 'Electronics', 'diam.', 'bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nun', 91, 60),
(2, 85, 'Electronics', 'faucibus', 'semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor. Fusce mi lo', 36, 93),
(1, 86, 'Shoes', 'Aliquam vulputate', 'ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in', 51, 88),
(2, 87, 'Electronics', 'Curabitur consequat, lectus', 'dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti so', 88, 117),
(1, 88, 'Electronics', 'Nam ligula elit,', 'aliquet molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis felis. Donec tempor, est', 35, 43),
(2, 89, 'Electronics', 'ut, molestie in,', 'tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipi', 46, 125),
(3, 90, 'Computers', 'tempor augue ac', 'cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris quis turpis vitae', 51, 147),
(3, 91, 'Home', 'Nunc', 'iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonumm', 53, 101),
(2, 92, 'Electronics', 'quis turpis vitae', 'Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas.', 87, 133),
(2, 93, 'Home', 'arcu. Vivamus sit', 'ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel pede blandit congue. In sceler', 1, 80),
(3, 94, 'Computers', 'nec,', 'scelerisque neque. Nullam nisl. Maecenas malesuada fringilla est. Mauris eu turpis. Nulla aliquet. P', 50, 96),
(4, 95, 'Computers', 'rhoncus.', 'ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, r', 99, 27),
(1, 96, 'Clothing', 'metus. Aenean', 'Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus rutrum', 56, 26),
(3, 97, 'Shoes', 'ipsum dolor sit', 'congue. In scelerisque scelerisque dui. Suspendisse ac metus vitae velit egestas lacinia. Sed congue', 99, 16),
(2, 98, 'Clothing', 'dolor, tempus non,', 'semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc.', 38, 17),
(3, 99, 'Shoes', 'elementum purus, accumsan', 'id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridicul', 5, 25),
(3, 100, 'Clothing', 'tincidunt. Donec', 'quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lo', 78, 89),
(2, 101, 'Computers', 'massa. Vestibulum', 'facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictu', 1, 72);

-- --------------------------------------------------------

--
-- Table structure for table `Ratings`
--

CREATE TABLE IF NOT EXISTS `Ratings` (
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ratings`
--

INSERT INTO `Ratings` (`member_id`, `product_id`, `Value`) VALUES
(1, 3, 4),
(1, 4, 3),
(2, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE IF NOT EXISTS `Reviews` (
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Message` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`member_id`, `product_id`, `Message`) VALUES
(1, 3, 'Test Review'),
(1, 4, 'Test Review');

-- --------------------------------------------------------

--
-- Table structure for table `Subscriptions`
--

CREATE TABLE IF NOT EXISTS `Subscriptions` (
  `customer_id` int(11) NOT NULL,
  `NewsLetter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Suppliers`
--

CREATE TABLE IF NOT EXISTS `Suppliers` (
`SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(30) NOT NULL,
  `Phone` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Suppliers`
--

INSERT INTO `Suppliers` (`SupplierID`, `SupplierName`, `Phone`) VALUES
(1, 'iajsd kndsa', '99999'),
(2, 'jahds aksdhkj', '88888'),
(3, 'aknd kadsnkn kasnd', '77777'),
(4, 'mbszd jdj', '4444');

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE IF NOT EXISTS `Transactions` (
`TransactionID` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ApprovalStatus` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
`MemberID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role` enum('Admin','Shopper') NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `Gender` enum('F','M') DEFAULT NULL,
  `BirthDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1128 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`MemberID`, `Username`, `Password`, `Role`, `Email`, `Fullname`, `Phone`, `Gender`, `BirthDate`) VALUES
(1, 'est', 'DYC29GUS6KK', 'Shopper', 'fringilla.euismod.enim@maurisrhoncusid.net', 'Rowan Dent', '(016977) 8692', 'F', '1967-09-20'),
(2, 'eu', 'MPY07GYS6SC', 'Shopper', 'libero@adipiscing.com', 'Olympia Sims', '0311 372 1444', 'M', '1981-08-05'),
(3, 'leo.', 'PYV04NQE8JY', 'Shopper', 'ut.molestie.in@ac.org', 'Moana Delgado', '076 0308 8022', 'F', '1954-06-04'),
(4, 'malesuada', 'MZF41UVC3UE', 'Shopper', 'porttitor.tellus@ligula.net', 'Zena Snider', '(01098) 59608', 'F', '2008-11-14'),
(5, 'vitae', 'ZZG11OSP9IA', 'Shopper', 'tincidunt@Integereu.net', 'Sage Oneal', '0800 780 4898', 'M', '1980-05-02'),
(6, 'mi', 'FRP92TTJ4XB', 'Shopper', 'lacus.Cras@NullafacilisiSed.org', 'Alexa Glover', '0800 1111', 'F', '1926-08-18'),
(7, 'cursus,', 'GMX98PCN9ZV', 'Shopper', 'nascetur@egestas.edu', 'Whitney Stevenson', '(01620) 38076', 'F', '1952-11-28'),
(8, 'Ut', 'ONU69OLW8ES', 'Shopper', 'ac@ornareliberoat.com', 'Molly Snider', '0800 047262', 'M', '1921-04-05'),
(9, 'amet,', 'UYX83YGV5CL', 'Shopper', 'erat.nonummy@pharetranibh.ca', 'Mona Russell', '(015389) 95384', 'F', '1985-12-04'),
(10, 'ante.', 'ELD53EIJ3XO', 'Shopper', 'conubia.nostra.per@Donec.edu', 'Summer Knapp', '(026) 2355 7444', 'M', '1965-11-21'),
(11, 'lorem,', 'IEJ52OVY4XE', 'Shopper', 'mollis.dui.in@lacusEtiambibendum.co.uk', 'Megan Hanson', '0845 46 40', 'F', '1929-07-08'),
(12, 'turpis', 'OIU96IOL1AD', 'Shopper', 'nulla.Donec.non@ipsum.org', 'April Jacobs', '0500 879813', 'M', '2003-12-25'),
(13, 'Aliquam', 'AQQ77REV1UA', 'Shopper', 'Quisque@egetdictum.ca', 'Iliana Carney', '(017567) 03773', 'F', '1934-02-23'),
(14, 'enim.', 'LSL41FSP8RD', 'Shopper', 'justo.Praesent@imperdietdictummagna.net', 'Gwendolyn Schneider', '0800 472 3112', 'F', '1997-06-15'),
(15, 'libero', 'WMF57NLN6RU', 'Shopper', 'est.mollis@metusurnaconvallis.co.uk', 'Chanda Burt', '070 1991 5022', 'F', '1991-08-28'),
(16, 'magna.', 'YGZ23LHJ4DR', 'Shopper', 'Ut.tincidunt@pharetrautpharetra.net', 'Rina Dillard', '0800 1111', 'F', '1974-03-20'),
(17, 'In', 'HNL91XMI2WZ', 'Shopper', 'laoreet.libero@Donecluctus.org', 'Angelica Pena', '0845 46 46', 'F', '1995-01-20'),
(18, 'nisi.', 'FCC45BJC5LN', 'Shopper', 'vulputate@Phasellusvitaemauris.net', 'Latifah Kramer', '(0114) 168 6634', 'F', '1980-02-14'),
(19, 'Vestibulum', 'TLR31JVF4EZ', 'Shopper', 'cursus.luctus.ipsum@mattissemperdui.org', 'Dawn Beasley', '0500 458251', 'F', '1966-04-26'),
(20, 'vehicula', 'XNJ52YBD1FQ', 'Shopper', 'lacus.Aliquam.rutrum@sedconsequatauctor.com', 'Quintessa Stevenson', '(018739) 38559', 'F', '1937-02-27'),
(21, 'metus.', 'KUU70JCQ0JD', 'Shopper', 'lectus@nisiCumsociis.net', 'Mara Tate', '070 5634 9981', 'F', '1990-06-22'),
(22, 'ut', 'XFJ43LQH1BY', 'Shopper', 'purus@posuerevulputatelacus.com', 'Quinn Serrano', '0845 46 44', 'F', '1988-04-10'),
(23, 'sed,', 'BYO10MUD0HS', 'Shopper', 'at.egestas@aodio.com', 'Aurelia Owens', '070 5426 0502', 'M', '1978-11-13'),
(24, 'vel,', 'JOG13ENR8VA', 'Shopper', 'Maecenas.mi.felis@aauctor.ca', 'Summer Carr', '(01643) 054285', 'M', '1943-01-05'),
(25, 'egestas.', 'RAH57FCV6VI', 'Shopper', 'aliquet@Integersemelit.ca', 'Yoshi Compton', '0800 1111', 'M', '2009-05-23'),
(26, 'morbi', 'EFP31FNI4GP', 'Shopper', 'dui.lectus.rutrum@estNunclaoreet.org', 'Veda Holt', '0845 46 42', 'F', '1991-09-02'),
(27, 'Cras', 'UOD25WKU2PU', 'Shopper', 'ridiculus@erategettincidunt.co.uk', 'Adrienne Reese', '0800 1111', 'M', '1987-10-12'),
(28, 'Fusce', 'PIU55TGB6DP', 'Shopper', 'nunc.est@Nam.net', 'Idona House', '0500 807598', 'F', '1989-11-16'),
(29, 'neque.', 'FNE62FNG2AY', 'Shopper', 'vehicula.aliquet.libero@ultriciesligula.edu', 'Tara Mathis', '076 4092 6554', 'F', '1941-04-09'),
(30, 'Curae;', 'VCW54BNB8XL', 'Shopper', 'non@utipsum.edu', 'Pandora Vazquez', '076 2703 5943', 'F', '1990-11-09'),
(31, 'ut,', 'PGM76TUA7VC', 'Shopper', 'luctus.aliquet.odio@dictum.org', 'Isabelle Hardin', '0800 390 4405', 'M', '1968-09-23'),
(32, 'primis', 'SDX60HUU5FN', 'Shopper', 'Maecenas.ornare@Donecegestas.ca', 'Sara Roman', '(01399) 12037', 'F', '2004-05-03'),
(33, 'faucibus', 'AZC05HTQ0JN', 'Shopper', 'sit.amet.ornare@nibhsit.org', 'Mechelle Hutchinson', '07457 775858', 'F', '2004-01-15'),
(34, 'diam.', 'EQO37XHZ7PT', 'Shopper', 'interdum.libero.dui@tortor.net', 'Quintessa Duran', '(015446) 08461', 'F', '2003-07-05'),
(35, 'nec', 'JBS93UQS1MP', 'Shopper', 'Nunc.quis.arcu@egetvolutpatornare.org', 'Mechelle Joseph', '0500 498573', 'M', '1930-09-12'),
(36, 'sit', 'WLT12XGR4OX', 'Shopper', 'Integer.tincidunt@eu.ca', 'Yen Spence', '07650 884098', 'F', '1975-11-13'),
(37, 'elit', 'RZN98TQY1VC', 'Shopper', 'massa.Integer.vitae@urna.org', 'Madeline Cox', '0800 040 8017', 'M', '1948-09-21'),
(38, 'lacinia', 'UGO66DEM9QF', 'Shopper', 'semper.rutrum.Fusce@Uttinciduntvehicula.org', 'Shay Thornton', '070 1888 3688', 'M', '1950-04-24'),
(39, 'Nunc', 'HRR55RZS5YV', 'Shopper', 'pede.Cum@velvulputate.edu', 'Velma Tate', '0800 080455', 'M', '1977-01-29'),
(40, 'parturient', 'IGX69LNK3LO', 'Shopper', 'erat.Sed.nunc@mauris.org', 'Pamela Tanner', '(018820) 70140', 'M', '1977-12-11'),
(41, 'imperdiet,', 'FEC04GIX4UL', 'Shopper', 'sapien.molestie.orci@dolorsit.net', 'Orli Hobbs', '(0119) 664 7491', 'F', '1979-01-24'),
(42, 'tellus.', 'TOS52WEK0SH', 'Shopper', 'orci.Donec.nibh@conubianostra.edu', 'Kylie Lawrence', '0500 358532', 'M', '2007-11-01'),
(43, 'sem.', 'GZQ99AJN7JX', 'Shopper', 'cursus.et@vulputate.net', 'Ulla Arnold', '0800 1111', 'M', '1997-03-09'),
(44, 'malesuada', 'BKX57XMW3WV', 'Shopper', 'eros.turpis@semperdui.edu', 'Destiny Burke', '(015364) 29491', 'F', '1949-04-30'),
(45, 'quis,', 'DFK32ZKB9FX', 'Shopper', 'eget.magna@acorciUt.net', 'Dana Randolph', '0811 538 6811', 'M', '1946-08-12'),
(46, 'bibendum.', 'DLD77PJW6KS', 'Shopper', 'cursus@massaVestibulumaccumsan.com', 'Ursula Romero', '(013414) 17421', 'M', '2003-10-29'),
(47, 'mauris', 'XAE44ALP3DT', 'Shopper', 'Pellentesque.ultricies.dignissim@acmieleifend.org', 'Lysandra Hart', '(021) 6530 2499', 'M', '2000-03-13'),
(48, 'Praesent', 'IAS93DVJ2EO', 'Shopper', 'nascetur@id.ca', 'Tasha Douglas', '(024) 9404 9372', 'M', '1966-04-09'),
(49, 'tempus', 'QBP47CKW0ND', 'Shopper', 'conubia@Proinnon.org', 'Chava Buckner', '0500 136909', 'F', '1983-02-28'),
(50, 'at', 'HAH36OOC7PF', 'Shopper', 'in.magna@pretiumneque.edu', 'Madonna Knight', '(016977) 3354', 'M', '1981-06-04'),
(51, 'nibh.', 'ZJV47IHG5EQ', 'Shopper', 'pharetra.ut.pharetra@ante.net', 'Adena Harrington', '0500 483517', 'F', '1973-02-08'),
(52, 'sapien.', 'UBN76CWK3SI', 'Shopper', 'odio.auctor@nisiMauris.edu', 'Vivian Baldwin', '07624 715115', 'F', '1938-04-23'),
(53, 'dictum', 'ZWX22JUL0SA', 'Shopper', 'est@mattissemperdui.net', 'Gillian Buckley', '0845 46 42', 'F', '1953-01-06'),
(54, 'semper', 'LCA30IYQ9VD', 'Shopper', 'vulputate.nisi@ipsumprimisin.edu', 'Dakota Nielsen', '0800 416573', 'M', '1995-05-11'),
(55, 'in,', 'LDJ55PCH9FD', 'Shopper', 'magna.Nam.ligula@etmalesuadafames.co.uk', 'Heather Wise', '(0110) 168 8293', 'F', '2000-05-04'),
(56, 'primis', 'INF40OUS5YI', 'Shopper', 'amet@laciniamattis.edu', 'Athena Stephenson', '(016977) 3457', 'F', '1951-12-03'),
(57, 'elit,', 'OGN85IPW3ZD', 'Shopper', 'diam.vel.arcu@tellus.com', 'Chanda Wynn', '070 7107 6132', 'F', '1941-11-07'),
(58, 'leo.', 'VJM20BFG9VN', 'Shopper', 'sapien.molestie.orci@quis.co.uk', 'Neve Vargas', '0359 289 7042', 'F', '1920-09-04'),
(59, 'Nulla', 'FOB73AON5PW', 'Shopper', 'eu@magna.ca', 'Claire Warner', '(010960) 54662', 'F', '1944-03-05'),
(60, 'et', 'TTW70IWS9WU', 'Shopper', 'interdum@pellentesquemassalobortis.edu', 'Kendall Warner', '07547 608361', 'F', '1999-08-01'),
(61, 'id,', 'LCZ34YGO6LV', 'Shopper', 'neque.vitae@Cum.org', 'Zorita Blevins', '(0119) 445 9210', 'F', '1993-11-12'),
(62, 'commodo', 'PXD74SJW9KT', 'Shopper', 'adipiscing.ligula@estac.com', 'Winifred Estes', '(01819) 662029', 'F', '2000-03-28'),
(63, 'Cum', 'XDS58LHZ3AF', 'Shopper', 'iaculis.odio.Nam@vitaepurusgravida.ca', 'Hillary Joseph', '070 6068 1429', 'M', '1991-01-09'),
(64, 'sem,', 'TJQ78HBW1SW', 'Shopper', 'nec@imperdiet.ca', 'Nyssa Wyatt', '(01956) 042813', 'M', '1930-09-25'),
(65, 'tempor', 'ZAO08CWY7SH', 'Shopper', 'molestie.tortor@magnisdis.ca', 'Candace Calhoun', '(01069) 09403', 'F', '1925-04-12'),
(66, 'sociis', 'KXD64PPZ8YM', 'Shopper', 'Morbi.accumsan.laoreet@aliquetmagnaa.net', 'Jael Sampson', '076 8159 9327', 'F', '1946-07-20'),
(67, 'Phasellus', 'ZQE19QUK5HY', 'Shopper', 'ac.risus.Morbi@eleifendnon.org', 'India Butler', '055 6599 6567', 'M', '1952-08-23'),
(68, 'eget', 'KUN49OPY8EF', 'Shopper', 'hendrerit.Donec.porttitor@VivamusrhoncusDonec.net', 'Laura Nguyen', '056 5138 3930', 'F', '1925-08-03'),
(69, 'est,', 'PPO60GCD3WZ', 'Shopper', 'amet.diam@mattis.org', 'Oprah Cruz', '(016977) 0988', 'M', '1931-12-09'),
(70, 'ac', 'UWS73UDK8BJ', 'Shopper', 'Integer.id@etultrices.org', 'Raven York', '(0121) 553 0667', 'F', '1995-07-25'),
(71, 'scelerisque', 'VWA90SOD9GY', 'Shopper', 'at.lacus@nulla.com', 'Eliana Butler', '0845 46 43', 'F', '1926-06-02'),
(72, 'consequat', 'JNL92VXD0KG', 'Shopper', 'neque@acsemut.edu', 'Tanisha Holt', '(01847) 699187', 'F', '1921-12-27'),
(73, 'amet,', 'FPX23OOE0WX', 'Shopper', 'Nulla.facilisis.Suspendisse@sit.com', 'Mary Hewitt', '070 2949 2452', 'F', '1960-04-22'),
(74, 'Nam', 'UWL53WXB7NE', 'Shopper', 'lorem@Utnec.edu', 'Sloane Callahan', '07123 769974', 'M', '1930-11-17'),
(75, 'Nulla', 'AFN71HLQ6VE', 'Shopper', 'Cum.sociis.natoque@utlacusNulla.com', 'Adrienne Waller', '07867 441427', 'M', '1925-05-11'),
(76, 'quis', 'HUD18XIP4NI', 'Shopper', 'sem.elit@arcuvel.edu', 'Ciara Sullivan', '0800 1111', 'F', '1931-03-27'),
(77, 'Phasellus', 'UVU59NKR8IY', 'Shopper', 'Quisque.purus@eratSed.co.uk', 'Lysandra Weiss', '0800 1111', 'M', '1930-03-23'),
(78, 'libero.', 'HXS73LOA8MV', 'Shopper', 'placerat@pedenec.edu', 'Olympia Wood', '076 3541 9846', 'F', '1933-06-25'),
(79, 'volutpat.', 'RRG87OPD3PQ', 'Shopper', 'nibh.lacinia.orci@netus.co.uk', 'Virginia Rivers', '(0151) 128 0753', 'F', '1930-06-16'),
(80, 'Nunc', 'IVK54WWR9KV', 'Shopper', 'et@Donec.net', 'Sonya Workman', '056 1112 6292', 'M', '1981-06-01'),
(81, 'ipsum.', 'FNI52IEE5AG', 'Shopper', 'Cum.sociis.natoque@mollislectuspede.edu', 'Larissa Mccullough', '0879 632 3439', 'M', '1999-10-09'),
(82, 'pellentesque,', 'ILI52QOD6NU', 'Shopper', 'in.molestie.tortor@Etiamlaoreetlibero.co.uk', 'Maris Klein', '0800 139971', 'F', '1952-07-08'),
(83, 'ornare,', 'CZD24XAT9FV', 'Shopper', 'lobortis.Class.aptent@VivamusrhoncusDonec.org', 'Leandra Blake', '(016977) 8092', 'F', '1941-02-28'),
(84, 'dis', 'MKV99VOJ1ZT', 'Shopper', 'Donec.egestas@consequatpurusMaecenas.co.uk', 'Lacy Pugh', '0800 494 5523', 'F', '2008-03-12'),
(85, 'lectus', 'TBH80ACP8LH', 'Shopper', 'lorem.ut@metussit.edu', 'Jordan Riddle', '0500 092889', 'M', '1927-02-28'),
(86, 'lorem,', 'SVQ19FQM9FX', 'Shopper', 'dis@magna.org', 'Savannah Cotton', '055 1943 0317', 'F', '1920-02-08'),
(87, 'Duis', 'WZF94KRU2OH', 'Shopper', 'ultrices@vulputatemauris.net', 'Halla Branch', '0800 382 9298', 'F', '1964-03-17'),
(88, 'convallis', 'XSX84GHF3FQ', 'Shopper', 'velit@tristique.net', 'Unity Mullen', '(029) 6326 3284', 'M', '1941-06-26'),
(89, 'eu', 'COO73HJP0PI', 'Shopper', 'Nulla.tempor@feugiatLoremipsum.edu', 'Rylee Good', '0397 306 6540', 'F', '1978-02-11'),
(90, 'Phasellus', 'ZVX94SVN7BV', 'Shopper', 'elementum.purus.accumsan@diamSed.org', 'Zia Stuart', '(016977) 2232', 'M', '1975-01-04'),
(91, 'dolor', 'EXK87JNQ9TS', 'Shopper', 'dictum.eu@natoquepenatibuset.org', 'Jordan Peck', '0817 873 8229', 'F', '2006-06-14'),
(92, 'faucibus.', 'VSA68WBU1SZ', 'Shopper', 'lorem.semper@Integer.org', 'Lacey Wolfe', '056 6179 2699', 'M', '1989-04-08'),
(93, 'lacus.', 'BIU70EXI2LK', 'Shopper', 'eu.eleifend@facilisiSed.net', 'Astra Short', '(01982) 462424', 'M', '1998-05-03'),
(94, 'pretium', 'LUH73BDI0OK', 'Shopper', 'vitae@nonantebibendum.edu', 'Kristen Scott', '0346 184 7859', 'M', '1965-03-09'),
(95, 'Aenean', 'GKK96IRI2BB', 'Shopper', 'est.Nunc.laoreet@semmagna.net', 'Evelyn Schultz', '(0116) 948 3229', 'F', '1988-12-04'),
(96, 'egestas.', 'QRH56TPL6TV', 'Shopper', 'nisl@erateget.net', 'Mallory Valdez', '055 8170 9699', 'F', '1932-08-13'),
(97, 'sollicitudin', 'CFI06GEG3CY', 'Shopper', 'Donec.porttitor@accumsansed.net', 'Carolyn Hickman', '(01994) 455530', 'M', '1922-12-12'),
(98, 'sit', 'KIZ96XCR6LB', 'Shopper', 'eleifend.non@vitae.org', 'Hanna Blake', '(0171) 861 2292', 'M', '1931-03-10'),
(99, 'venenatis', 'FKK42ODW6RS', 'Shopper', 'Etiam@arcueuodio.ca', 'Hyacinth Patterson', '0800 642988', 'F', '1954-07-26'),
(100, 'leo', 'KRZ72FIZ9EK', 'Shopper', 'vestibulum.neque.sed@mollisnon.ca', 'Roary Pace', '056 0655 6327', 'M', '1934-12-02'),
(1125, 'est1', 'DYC29GUS6KK', 'Shopper', 'test@test.com', 'test', '1111', 'M', '2018-04-03'),
(1126, 'est2', 'DYC29GUS6KK', 'Shopper', 'test3@ytr.com', 'fdf', 'fdf', 'M', '2018-04-24'),
(1127, 'srk1', 'srksrk', 'Shopper', 'srk1@qem.com', 'Srk', '5050550055', 'M', '2001-02-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Addresses`
--
ALTER TABLE `Addresses`
 ADD PRIMARY KEY (`AddressID`), ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `Carts`
--
ALTER TABLE `Carts`
 ADD PRIMARY KEY (`member_id`,`product_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `OrderProducts`
--
ALTER TABLE `OrderProducts`
 ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
 ADD PRIMARY KEY (`OrderID`), ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
 ADD PRIMARY KEY (`ProductID`,`ProductType`), ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `Ratings`
--
ALTER TABLE `Ratings`
 ADD PRIMARY KEY (`member_id`,`product_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
 ADD PRIMARY KEY (`member_id`,`product_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Subscriptions`
--
ALTER TABLE `Subscriptions`
 ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `Suppliers`
--
ALTER TABLE `Suppliers`
 ADD PRIMARY KEY (`SupplierID`);

--
-- Indexes for table `Transactions`
--
ALTER TABLE `Transactions`
 ADD PRIMARY KEY (`TransactionID`), ADD KEY `member_id` (`member_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
 ADD PRIMARY KEY (`MemberID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Addresses`
--
ALTER TABLE `Addresses`
MODIFY `AddressID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Suppliers`
--
ALTER TABLE `Suppliers`
MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Transactions`
--
ALTER TABLE `Transactions`
MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1128;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Addresses`
--
ALTER TABLE `Addresses`
ADD CONSTRAINT `Addresses_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `Users` (`MemberID`);

--
-- Constraints for table `Carts`
--
ALTER TABLE `Carts`
ADD CONSTRAINT `Carts_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `Users` (`MemberID`),
ADD CONSTRAINT `Carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Products` (`ProductID`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `Users` (`MemberID`);

--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
ADD CONSTRAINT `Products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `Suppliers` (`SupplierID`);

--
-- Constraints for table `Ratings`
--
ALTER TABLE `Ratings`
ADD CONSTRAINT `Ratings_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `Users` (`MemberID`),
ADD CONSTRAINT `Ratings_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Products` (`ProductID`);

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
ADD CONSTRAINT `Reviews_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `Users` (`MemberID`),
ADD CONSTRAINT `Reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Products` (`ProductID`);

--
-- Constraints for table `Subscriptions`
--
ALTER TABLE `Subscriptions`
ADD CONSTRAINT `Subscriptions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `Users` (`MemberID`);

--
-- Constraints for table `Transactions`
--
ALTER TABLE `Transactions`
ADD CONSTRAINT `Transactions_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `Users` (`MemberID`),
ADD CONSTRAINT `Transactions_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Products` (`ProductID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;