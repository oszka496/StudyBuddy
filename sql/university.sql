CREATE TABLE IF NOT EXISTS `university` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(100) NOT NULL,
	`uniAddress` TEXT NOT NULL,
	`tags` VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP PROCEDURE IF EXISTS check_uni;
CREATE PROCEDURE check_uni(adr VARCHAR(150))
BEGIN
	SELECT `id` FROM `university` WHERE `uniAddress` = adr;
END;

DROP PROCEDURE IF EXISTS insert_uni;
CREATE PROCEDURE insert_uni(uname VARCHAR(100), adr VARCHAR(150), keyWords TEXT)
BEGIN
	INSERT INTO `university` (`name`, `uniAddress`, `tags`) VALUES (uname, adr, keyWords);
END;

DROP PROCEDURE IF EXISTS delete_uni;
CREATE PROCEDURE delete_uni(adr VARCHAR(150))
BEGIN
	DELETE FROM `university` WHERE `uniAddress` = adr;
END;