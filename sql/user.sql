CREATE TABLE IF NOT EXISTS `user` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`email` VARCHAR(50) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`fname` VARCHAR(20) NOT NULL,
	`lname` VARCHAR(40) NOT NULL,
	`status` ENUM('teacher','student') 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP PROCEDURE IF EXISTS get_user;
CREATE PROCEDURE get_user(em  VARCHAR(50));
BEGIN
	SELECT `id`, `password`, `fname`, `lname` FROM `user` WHERE `email` = em;
END;

DROP PROCEDURE IF EXISTS insert_user;
CREATE PROCEDURE insert_user(em VARCHAR(50), pass VARCHAR(255), fnm VARCHAR(20), lnm VARCHAR(40), stat ENUM);
BEGIN
	INSERT INTO `user` ( `email`, `password`, `fname`, `lname`, `status`) VALUES (em, pass, fnm, lnm, stat);
END;

