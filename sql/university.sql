CREATE TABLE IF NOT EXISTS `university` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(100) NOT NULL,
	`uniAddress` TEXT NOT NULL,
	`tags` TEXT,
	`email` VARCHAR(50)
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
CREATE PROCEDURE delete_uni(uid INT(11))
BEGIN
	DELETE FROM `university` WHERE `id` = uid;
END;

DROP PROCEDURE IF EXISTS show_uni;
CREATE PROCEDURE show_uni()
BEGIN
	SELECT * FROM `university`;
END;

DROP PROCEDURE IF EXISTS change_uni_name;
CREATE PROCEDURE change_uni_name(uid INT(11), un VARCHAR(100))
BEGIN
	UPDATE `problemset` SET `name`=`un` WHERE `id`=`uid`;
END;

DROP PROCEDURE IF EXISTS change_uni_address;
CREATE PROCEDURE change_ps_address(uid INT(11), adr VARCHAR(150))
BEGIN
	UPDATE `problemset` SET `psAddress`=`adr` WHERE `id`=`uid`;
END;

DROP PROCEDURE IF EXISTS change_uni_tags;
CREATE PROCEDURE change_uni_tags(uid INT(11), utags TEXT)
BEGIN
	UPDATE `problemset` SET `tags`=`utags` WHERE `id`=`uid`;
END;

DROP PROCEDURE IF EXISTS change_uni_mail; umail VARCHAR(50))
BEGIN
	UPDATE `problemset` SET `email`=`umail` WHERE `id`=`uid`;
END;

