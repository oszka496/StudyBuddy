CREATE TABLE IF NOT EXISTS `enrolled` (
	`studentId` INT(11) NOT NULL,
	`courseId` INT(11) NOT NULL,
	FOREIGN KEY (`studentId`) REFERENCES user(`id`) ON DELETE CASCADE,
	FOREIGN KEY (`courseId`) REFERENCES courses(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP PROCEDURE IF EXISTS choose_course;
CREATE PROCEDURE choose_course(sid INT, cid INT)
BEGIN
	INSERT INTO `enrolled`(`studentId`, `courseId`) VALUES (sid,cid);
END;

DROP PROCEDURE IF EXISTS show_my_courses;
CREATE PROCEDURE show_my_courses(uid INT(11))
BEGIN
	SELECT `courses`.`name`, `courses`.`id`, `courses`.`courseAddress` 
	FROM `enrolled` INNER JOIN `courses`
	WHERE `enrolled`.`studentId`=uid AND `courses`.`id`=`enrolled`.`courseId`;
END;

DROP PROCEDURE IF EXISTS check_enroll;
CREATE PROCEDURE check_enroll(sid INT(11), cid INT(11))
BEGIN
	SELECT * FROM `enrolled` WHERE `studentId`=sid AND `courseId`=cid;
END;

DROP PROCEDURE IF EXISTS resign_from_course;
CREATE PROCEDURE resign_from_course(sid INT(11), cid INT(11))
BEGIN
	DELETE FROM `enrolled` WHERE `studentId`=sid AND `courseId`=cid;
END;

DROP PROCEDURE IF EXISTS get_xml_data;
CREATE PROCEDURE get_xml_data(uid INT(11))
BEGIN
	SELECT DISTINCT `university`.`name` AS `uniName`, `courses`.`uniId`, `courses`.`id`,
	`courses`.`name` AS `cName`, `courses`.`lecturerId`, `courses`.`courseStart`, 
	`courses`.`courseEnd`, `courses`.`courseAddress`,
	`problemset`.`name` AS `psName`, `problemset`.`deadline`, `problemset`.`psAddress`
	FROM `enrolled` INNER JOIN `courses` INNER JOIN `university` INNER JOIN `problemset`
	WHERE `enrolled`.`studentId` = uid AND `courses`.`id` = `problemset`.`courseId`
	ORDER BY `courses`.`courseStart`;
END;