CREATE TABLE IF NOT EXISTS `problemset` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`courseId` INT(11) NOT NULL,
	`deadline` date,
	`psAddress` VARCHAR(150) NOT NULL,
	FOREIGN KEY (`courseId`) REFERENCES courses(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP PROCEDURE IF EXISTS insert_ps;
CREATE PROCEDURE insert_ps(cid INT(11), ddline date, adr VARCHAR(150))
BEGIN
	INSERT INTO `problemset` (`courseId`, `deadline`, `psAddress`) VALUES (cid, ddline, adr);
END;

DROP PROCEDURE IF EXISTS show_ps;
CREATE PROCEDURE show_ps(cid INT(11))
BEGIN
	SELECT `problemset`.`id`, `problemset`.`deadline`, `problemset`.`psAddress` 
	FROM `problemset` INNER JOIN `courses` 
	WHERE `problemset`.`courseId`=`courses`.`id` AND `courses`.`id` = cid;
END
