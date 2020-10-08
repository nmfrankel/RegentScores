-- Last modified 8/13/2020

-- create the database
CREATE DATABASE IF NOT EXISTS `regentScores` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `regentScores`;


-- create users table
CREATE TABLE IF NOT EXISTS users (
	`id` int(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`),
	`status` int(11) DEFAULT 0,
	`first` text NOT NULL,
	`last` text NOT NULL,
	`student_id` text,
	`dob` int(11) NOT NULL,
	`authToken` text NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- fill table with admin user and 1 test user
INSERT INTO `users` (`id`, `status`, `first`, `last`, `student_id`, `dob`, `authToken`) VALUES
	(NULL, 1, 'Admin', 'username', 'password', 0, NULL),
	(NULL, 2, 'Nosson Meir', 'Frankel', '613000000', 974851200, NULL);


-- create scores table
CREATE TABLE IF NOT EXISTS scores (
	`id` INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`),
	`student` int(11) NOT NULL,
	`regent_id` int(11) NOT NULL,
	`grade` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


-- create regent table
CREATE TABLE IF NOT EXISTS regent (
	`id` int(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`),
	`subject` text NOT NULL,
	`date` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
