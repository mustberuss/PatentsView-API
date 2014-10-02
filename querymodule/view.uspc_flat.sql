select `uspc`.`uuid` AS `uspc_id`,`uspc`.`sequence` AS `sequence`,`uspc`.`patent_id` AS `uspc_patent_id`,`mainclass`.`id` AS `mainclass_id`,`mainclass`.`title` AS `mainclass_title`,`mainclass`.`text` AS `mainclass_text`,`subclass`.`id` AS `subclass_id`,`subclass`.`title` AS `subclass_title`,`subclass`.`text` AS `subclass_text` from ((`uspc` left join `mainclass` on((`uspc`.`mainclass_id` = `mainclass`.`id`))) left join `subclass` on((`uspc`.`subclass_id` = `subclass`.`id`)))