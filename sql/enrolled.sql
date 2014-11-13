CREATE TABLE IF NOT EXISTS `enrolled` (
	`studentId` INT(11) NOT NULL,
	`courseId` INT(11) NOT NULL,
	FOREIGN KEY (`studentId`) REFERENCES user(`id`) ON DELETE CASCADE,
	FOREIGN KEY (`courseId`) REFERENCES courses(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;