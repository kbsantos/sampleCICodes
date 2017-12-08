UPDATE `resource_management`.`Activities` SET `customer_id`='4' WHERE  `id`=2;
UPDATE `resource_management`.`Activities` SET `customer_id`='3' WHERE  `id`=1;

UPDATE `resource_management`.`Activities` SET `event_id`='1' WHERE  `id`=1;
UPDATE `resource_management`.`Activities` SET `event_id`='1' WHERE  `id`=2;

UPDATE `resource_management`.`Activities` SET `technician_id`='1' WHERE  `id`=1;
UPDATE `resource_management`.`Activities` SET `technician_id`='2' WHERE  `id`=2;

DROP FUNCTION IF EXISTS `fn_get_activity_progress`;
DELIMITER //
CREATE FUNCTION `fn_get_activity_progress`(
	`user_id` INT,
	`source_id` INT
) RETURNS int(11)
BEGIN
	DECLARE progress INT;
	
	select FLOOR(((count(uae.`status`)/count(*))*100)) INTO progress
	from user_in_actual_event uae
	LEFT JOIN actual_events ae ON uae.actual_event_id = ae.id
	LEFT JOIN transactions t ON t.id = ae.transaction_id
	WHERE uae.user_id = user_id and ae.source_id = source_id;
	
	IF progress is null THEN
		SET progress = 0;
	END IF;

	RETURN progress;
END//
DELIMITER ;

-- Dumping structure for view resource_management.view_activity_grid
DROP VIEW IF EXISTS `view_activity_grid`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_activity_grid` (
	`id` INT(11) NOT NULL,
	`description` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`technician_name` VARCHAR(207) NULL COLLATE 'utf8_general_ci',
	`customer_name` VARCHAR(207) NULL COLLATE 'utf8_general_ci',
	`event_name` VARCHAR(128) NULL COLLATE 'utf8_general_ci',
	`assigne_date` TIMESTAMP NULL,
	`manager_name` VARCHAR(207) NULL COLLATE 'utf8_general_ci',
	`progress` INT(11) NULL,
	`type_id` INT(11) NULL,
	`technician_id` INT(11) NULL,
	`manager_id` INT(11) NULL,
	`event_id` INT(11) NULL,
	`customer_id` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for view resource_management.view_activity_grid
DROP VIEW IF EXISTS `view_activity_grid`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_activity_grid`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_activity_grid` AS select `a`.`id` AS `id`,`a`.`description` AS `description`,concat_ws(' ',`u`.`fname`,`u`.`mname`,`u`.`lname`) AS `technician_name`,concat_ws(' ',`c`.`fname`,`c`.`mname`,`c`.`lname`) AS `customer_name`,`e`.`name` AS `event_name`,IF(min(`uae`.`start_date`) IS NULL,NULL,date_format(min(`uae`.`start_date`),'%Y-%m-%d')) AS `assigne_date`,concat_ws(' ',`m`.`fname`,`m`.`mname`,`m`.`lname`) AS `manager_name`,CONCAT(`fn_get_activity_progress`(`a`.`technician_id`,`ae`.`source_id`),' %') AS `progress`,`a`.`type_id` AS `type_id`,`a`.`technician_id` AS `technician_id`,`a`.`manager_id` AS `manager_id`,`a`.`event_id` AS `event_id`,`a`.`customer_id` AS `customer_id` from (((((((`Activities` `a` left join `Users` `u` on((`u`.`id` = `a`.`technician_id`))) left join `Users` `m` on((`u`.`id` = `a`.`manager_id`))) left join `events` `e` on((`e`.`id` = `a`.`event_id`))) left join `Customers` `c` on((`c`.`id` = `a`.`customer_id`))) left join `transactions` `t` on((`e`.`id` = `t`.`event_id`))) left join `actual_events` `ae` on(((`a`.`id` = `ae`.`source_id`) and (`t`.`id` = `ae`.`transaction_id`)))) left join `user_in_actual_event` `uae` on(((`a`.`technician_id` = `uae`.`user_id`) and (`ae`.`id` = `uae`.`actual_event_id`)))) group by `a`.`id` order by `a`.`id` desc;
