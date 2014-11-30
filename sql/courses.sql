CREATE TABLE IF NOT EXISTS `courses` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(100) NOT NULL,
	`lecturerId` INT(11),
	`courseStart` date,
	`courseEnd` date,
	`courseAddress` VARCHAR(150) NOT NULL,
	`uniId` INT(11),
	FOREIGN KEY (`lecturerId`) REFERENCES user(`id`) ON DELETE CASCADE,
	FOREIGN KEY (`uniId`) REFERENCES university(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP PROCEDURE IF EXISTS insert_course;
CREATE PROCEDURE insert_course(cname VARCHAR(100), starts date, ends date, adr VARCHAR(150), uid INT(11))
BEGIN
	INSERT INTO `courses` (`name`, `courseStart`, `courseEnd`, `courseAddress`, `uniId`) VALUES (cname, starts, ends, adr, uid);
END;

DROP PROCEDURE IF EXISTS insert_dates;
CREATE PROCEDURE insert_dates(cid INT(11), starts date, ends date)
BEGIN
	UPDATE `courses` SET `courseStart`=starts AND `courseEnd`=ends WHERE `id`=cid;
END;

DROP PROCEDURE IF EXISTS insert_lecturer;
CREATE PROCEDURE insert_lecturer(cid INT(11), lid INT(11))
BEGIN
	UPDATE `courses` SET `lecturerId`=lid WHERE `id`=cid;
END;

DROP PROCEDURE IF EXISTS check_course;
CREATE PROCEDURE check_course(adr VARCHAR(150))
BEGIN
	SELECT `id` FROM `courses` WHERE `courseAddress` = adr;
END;

DROP PROCEDURE IF EXISTS show_course;
CREATE PROCEDURE show_course(uid INT(11))
BEGIN
	SELECT * FROM `courses` WHERE `uniId`=uid;
END;

DROP PROCEDURE IF EXISTS delete_course;
CREATE PROCEDURE delete_course(cid INT(11))
BEGIN
	DELETE FROM `courses` WHERE `id`=cid;
END