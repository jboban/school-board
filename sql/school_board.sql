--
-- Database: `school_board`
--

USE school_board;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `grade1` int(11) DEFAULT NULL,
  `grade2` int(11) DEFAULT NULL,
  `grade3` int(11) DEFAULT NULL,
  `grade4` int(11) DEFAULT NULL,
  `sb_type` enum('CSM','CSMB') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `grade1`, `grade2`, `grade3`, `grade4`, `sb_type`) VALUES
(1, 'Luka', 10, 6, 8, 7, 'CSM'),
(2, 'Milos', 6, 9, 9, 10, 'CSMB'),
(3, 'Aleksa', 6, 7, 7, 8, 'CSMB'),
(4, 'Boban', 8, 6, NULL, NULL, 'CSMB');
