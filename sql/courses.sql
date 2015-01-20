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
	INSERT INTO `courses` (`name`, `courseStart`, `courseEnd`, `courseAddress`, `uniId`) 
	VALUES (cname, starts, ends, adr, uid);
END;

DROP PROCEDURE IF EXISTS check_course;
CREATE PROCEDURE check_course(adr VARCHAR(150))
BEGIN
	SELECT `id` FROM `courses` WHERE `courseAddress` = adr;
END;

DROP PROCEDURE IF EXISTS show_course;
CREATE PROCEDURE show_course(uid INT(11), id INT(11))
BEGIN
	SELECT `courses`.`id`, `courses`.`name`, `courses`.`courseAddress`, `courses`.`lecturerId`, `j`.`isEnrolled`
	FROM `courses`, 
		(
			SELECT CASE WHEN `enrolled`.`studentId` IS NULL THEN 'N' ELSE 'Y' END isEnrolled
			FROM `courses` 
			LEFT JOIN `enrolled` ON `courses`.`id` = `enrolled`.`courseId` AND `enrolled`.`studentId`=id
		) j
	WHERE `uniId` = uid;
END;

DROP PROCEDURE IF EXISTS get_course;
CREATE PROCEDURE get_course(cid INT(11))
BEGIN
	SELECT * FROM `courses` WHERE `id`=cid;
END;

DROP PROCEDURE IF EXISTS delete_course;
CREATE PROCEDURE delete_course(cid INT(11))
BEGIN
	DELETE FROM `courses` WHERE `id`=cid;
END;

DROP PROCEDURE IF EXISTS change_start_date;
CREATE PROCEDURE change_start_date(cid INT(11), starts date)
BEGIN
	UPDATE `courses` SET `courseStart`=starts WHERE `id`=cid;
END;

DROP PROCEDURE IF EXISTS change_end_date;
CREATE PROCEDURE change_end_date(cid INT(11), ends date)
BEGIN
	UPDATE `courses` SET `courseEnd`=ends WHERE `id`=cid;
END;

DROP PROCEDURE IF EXISTS change_lecturer;
CREATE PROCEDURE change_lecturer(cid INT(11), lid INT(11))
BEGIN
	UPDATE `courses` SET `lecturerId`=lid WHERE `id`=cid;
END;

DROP PROCEDURE IF EXISTS change_address;
CREATE PROCEDURE change_address(cid INT(11), adr VARCHAR(150))
BEGIN
	UPDATE `courses` SET `courseAddress`=adr WHERE `id`=cid;
END;

DROP PROCEDURE IF EXISTS change_uni;
CREATE PROCEDURE change_uni(cid INT(11), uid INT(11))
BEGIN
	UPDATE `courses` SET `uniId`=uid WHERE `id`=cid;
END;

DROP PROCEDURE IF EXISTS get_course_by_lecturer;
CREATE PROCEDURE get_course_by_lecturer(lid INT(11))
BEGIN
	SELECT `id`, `name`, `courseAddress` FROM `courses` WHERE `lecturerId` = lid;
END;