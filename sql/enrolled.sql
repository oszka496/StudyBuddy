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
	SELECT `courses`.`name` FROM `enrolled` INNER JOIN `courses` WHERE `studentId`=uid;
END;
