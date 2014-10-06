-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2014 at 08:17 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm_users`
--

CREATE TABLE IF NOT EXISTS `adm_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adm_users`
--

INSERT INTO `adm_users` (`ID`, `username`, `password`, `status`) VALUES
(1, 'rohman', 'AGj2B7WLZClSyJg/PgV2UxIZ2G1vwrvi5SB4xur8p/EieVE6A/w8owYyjUVAynmSg1paZUqMELvJxbrCUwaKSg==', 1);

-- --------------------------------------------------------

--
-- Table structure for table `choice_answers`
--

CREATE TABLE IF NOT EXISTS `choice_answers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `exam_ID` varchar(20) NOT NULL,
  `a` tinytext NOT NULL,
  `b` tinytext NOT NULL,
  `c` tinytext NOT NULL,
  `d` tinytext NOT NULL,
  `e` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `choice_answers`
--

INSERT INTO `choice_answers` (`ID`, `exam_ID`, `a`, `b`, `c`, `d`, `e`) VALUES
(1, '1', 'saya', 'kamu', 'dia', 'mereka', 'kita'),
(2, '2', 'ini', 'itu', 'mana', 'siapa', 'bagaimana'),
(3, '3', 'ini', 'itu', 'mana', 'siapa', 'bagaimana'),
(4, '4', 'Bahasa yang digunakan untuk membuat seperti program alikasi perkantoran', 'bahasa yang digunakan untuk interaksi antar manusia', 'bahasa yang komplex dan tidak ada turunannya', 'semua jawaban diatas bernar', 'semua salah '),
(5, '5', 'karena sangatlah cocok untuk semua orang', 'karena bahasa yang terstruktur.', 'tidak sama dengan yang bahasa lainnya.', 'bahasa yang unik dan rapi', 'bahasa yang mudah dipahami'),
(6, '6', '3 macam', '1 macam', '2 macam', '16 macam', '6 macam'),
(7, '7', 'richard key', 'alberto salosa', 'daniel mandala', 'rohman ahmad', 'tidak tahu'),
(8, '8', 'adalah suatu aplikasi yang digunakan untuk data store pada internet', 'adalah sebuah aplikasi yang tidak ada tandingannya', 'suatu aplikasi yang berjalan pada internet', 'program aplikasi yang dirancang sebagai aplikasi untuk website', 'program aplikasi'),
(9, '9', 'kevin andreas', 'maulidul arzaki', 'rohman ahmad', 'patrick wilson', 'mbah google');

-- --------------------------------------------------------

--
-- Table structure for table `class_options`
--

CREATE TABLE IF NOT EXISTS `class_options` (
  `ID` int(11) NOT NULL,
  `class_code` varchar(4) NOT NULL,
  `class_name` varchar(5) NOT NULL,
  `index_order` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_options`
--

INSERT INTO `class_options` (`ID`, `class_code`, `class_name`, `index_order`, `status`) VALUES
(1, 'vi', 'VI', 0, 1),
(2, 'vii', 'VII', 1, 1),
(3, 'viii', 'XIII', 2, 1),
(4, 'ix', 'IX', 3, 1),
(5, 'x', 'X', 4, 1),
(6, 'xi', 'XI', 5, 1),
(7, 'xii', 'XII', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `correct_answer`
--

CREATE TABLE IF NOT EXISTS `correct_answer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `exam_ID` varchar(20) NOT NULL,
  `answer` varchar(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `correct_answer`
--

INSERT INTO `correct_answer` (`ID`, `exam_ID`, `answer`) VALUES
(1, '4', 'a'),
(2, '5', 'c'),
(3, '6', 'a'),
(4, '7', 'c'),
(5, '8', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE IF NOT EXISTS `exam_questions` (
  `exam_ID` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(20) NOT NULL,
  `class_code` varchar(5) NOT NULL,
  `exam_content` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`exam_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`exam_ID`, `subject_code`, `class_code`, `exam_content`, `status`) VALUES
(1, 'mat', 'vii', 'dasdasdasdasd', 1),
(2, 'mat', 'viii', 'asdasdasdaa123', 1),
(3, 'mat', 'vii', 'dasdasdasdasd3123123', 1),
(4, 'komp', 'x', 'Apa yang dimaksud dengan bahasa pemrograman?', 1),
(5, 'komp', 'x', 'Mengapa bahasa pemrograman sangat digemari?', 1),
(6, 'komp', 'x', 'Ada berapa macam Bahasa pemrograman yang berbasis object?', 1),
(7, 'komp', 'x', 'Siapa penemu bahasa pemrograman C?', 1),
(8, 'komp', 'x', 'Apa yang dimaksud dengan webserver?', 1),
(9, 'komp', 'x', 'siapa penemu webserver?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(20) NOT NULL,
  `subject_name` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`ID`, `subject_code`, `subject_name`, `status`) VALUES
(1, 'mat', 'matematika', 1),
(2, 'komp', 'Komputer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temporary_user_answers`
--

CREATE TABLE IF NOT EXISTS `temporary_user_answers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sess_ID` varchar(20) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `user` varchar(30) NOT NULL,
  `exam_ID` varchar(5) NOT NULL,
  `answer` varchar(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `temporary_user_answers`
--

INSERT INTO `temporary_user_answers` (`ID`, `sess_ID`, `date_time`, `user`, `exam_ID`, `answer`, `status`) VALUES
(48, '0310-komp-x', '2014-10-03 10:27:42', 'rohman', '4', 'A', 1),
(49, '0310-komp-x', '2014-10-03 10:27:42', 'rohman', '5', 'A', 0),
(50, '0310-komp-x', '2014-10-03 10:27:42', 'rohman', '6', 'B', 1),
(51, '0310-komp-x', '2014-10-03 10:27:42', 'rohman', '7', 'A', 1),
(52, '0310-komp-x', '2014-10-03 10:27:42', 'rohman', '8', 'C', 1),
(53, '0310-komp-x', '2014-10-03 10:27:46', 'rohman', '9', 'B', 0),
(54, '03100932-komp-x', '2014-10-03 15:10:24', 'rohman', '4', 'A', 1),
(55, '03100932-komp-x', '2014-10-03 15:10:24', 'rohman', '5', 'E', 0),
(56, '03100932-komp-x', '2014-10-03 15:10:25', 'rohman', '6', 'A', 1),
(57, '03100932-komp-x', '2014-10-03 15:10:25', 'rohman', '7', 'A', 0),
(58, '03100932-komp-x', '2014-10-03 15:10:25', 'rohman', '8', 'A', 1),
(59, '03100932-komp-x', '2014-10-03 15:10:30', 'rohman', '9', 'E', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_scores`
--

CREATE TABLE IF NOT EXISTS `user_scores` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime NOT NULL,
  `username` varchar(30) NOT NULL,
  `sess_ID` varchar(20) NOT NULL,
  `score` decimal(3,0) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_scores`
--

INSERT INTO `user_scores` (`ID`, `date_time`, `username`, `sess_ID`, `score`) VALUES
(1, '2014-10-03 10:38:58', 'rohman', '0310-komp-x', '50'),
(3, '2014-10-03 14:55:04', 'rohman', '0310-komp-x', '67'),
(4, '2014-10-03 14:56:21', 'rohman', '0310-komp-x', '67'),
(5, '2014-10-03 15:10:30', 'rohman', '03100932-komp-x', '50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
