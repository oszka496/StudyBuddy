CREATE TABLE IF NOT EXISTS `courses` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(100) NOT NULL,
	`lecturerId` INT(11),
	`courseStart` date,
	`courseEnd` date,
	`courseAddress` VARCHAR(150) NOT NULL,
	`uniId` INT(11) NOT NULL,
	FOREIGN KEY (`lecturerId`) REFERENCES user(`id`) ON DELETE CASCADE,
	FOREIGN KEY (`uniId`) REFERENCES university(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP PROCEDURE IF EXISTS insert_course;
CREATE PROCEDURE insert_course(cname VARCHAR(50), lid INT, startd date, endd date, adr VARCHAR(50))
BEGIN
	INSERT INTO `courses` (`name`, `lecturerId`, `courseStart`, `courseEnd`, `courseAddress`) VALUES (cname, lid, starts, ends, adr);
END;

DROP PROCEDURE IF EXISTS check_course;
CREATE PROCEDURE check_course(adr VARCHAR(50))
BEGIN
	SELECT `id` FROM `courses` WHERE `courseAddress` = adr;
END;

