CREATE TABLE IF NOT EXISTS `problemset` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(100),
	`courseId` INT(11) NOT NULL,
	`deadline` date,
	`psAddress` VARCHAR(150) NOT NULL,
	FOREIGN KEY (`courseId`) REFERENCES courses(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP PROCEDURE IF EXISTS insert_ps;
CREATE PROCEDURE insert_ps(psn VARCHAR(100), cid INT(11), ddline date, adr VARCHAR(150))
BEGIN
	INSERT INTO `problemset` (`name`,`courseId`, `deadline`, `psAddress`) VALUES (psn, cid, ddline, adr);
END;

DROP PROCEDURE IF EXISTS show_ps;
CREATE PROCEDURE show_ps(cid INT(11))
BEGIN
	SELECT `problemset`.`id`, `problemset`.`name`, `problemset`.`deadline`, `problemset`.`psAddress` 
	FROM `problemset` INNER JOIN `courses` 
	WHERE `problemset`.`courseId`=`courses`.`id` AND `courses`.`id` = cid;
END;

DROP PROCEDURE IF EXISTS check_ps;
CREATE PROCEDURE check_ps(adr VARCHAR(150))
BEGIN
	SELECT `id` FROM `problemset` WHERE `psAddress`=adr;
END;

DROP PROCEDURE IF EXISTS delete_ps;
CREATE PROCEDURE delete_ps(psid INT(11), cid INT(11))
BEGIN
	DELETE FROM `problemset` WHERE `id`=psid and `courseId`=cid;
END;

DROP PROCEDURE IF EXISTS change_ps_name;
CREATE PROCEDURE change_ps_name(psid INT(11), psn VARCHAR(100))
BEGIN
	UPDATE `problemset` SET `name`=`psn` WHERE `id`=`psid`;
END;

DROP PROCEDURE IF EXISTS change_ps_deadline;
CREATE PROCEDURE change_ps_deadline(psid INT(11), ddline date)
BEGIN
	UPDATE `problemset` SET `deadline`=`ddline` WHERE `id`=`psid`;
END;

DROP PROCEDURE IF EXISTS change_ps_address;
CREATE PROCEDURE change_ps_address(psid INT(11), adr VARCHAR(150))
BEGIN
	UPDATE `problemset` SET `psAddress`=`adr` WHERE `id`=`psid`;
END;

DROP PROCEDURE IF EXISTS change_ps_course;
CREATE PROCEDURE change_ps_course(psid INT(11), cid INT(11))
BEGIN
	UPDATE `problemset` SET `courseId`=`cid` WHERE `id`=`psid`;
END;

