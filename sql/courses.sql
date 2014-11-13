CREATE TABLE IF NOT EXISTS `courses` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(30) NOT NULL,
	`lecturerId` INT(11) NOT NULL,
	`courseStart` date,
	`courseEnd` date,
	FOREIGN KEY (`lecturerId`) REFERENCES user(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;