DROP PROCEDURE IF EXISTS suggest;
CREATE PROCEDURE suggest(inputs VARCHAR(100))
BEGIN
	SELECT `id`, `name`, `uniAddress`, `tags`
	FROM `university`
	WHERE `tags` LIKE CONCAT("%", inputs, "%");
END;