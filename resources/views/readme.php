

DELETE FROM `users` WHERE `id` > 1;

UPDATE `users` SET `is_adhaar_verified` = 2, `bank_kyc_status` = 2, `is_pan_verified` = 2;


<!-- seminar lead structure -->
ALTER TABLE `seminar_leads`  ADD `leader_name` VARCHAR(100) NULL  AFTER `date`,  ADD `place_seminar` VARCHAR(100) NULL  AFTER `leader_name`;
ALTER TABLE `registry_forms`  ADD `transaction_proof` TEXT NULL  AFTER `status`;


ALTER TABLE `digital_leads`  ADD `user_panel` INT NOT NULL  AFTER `updated_at`;
ALTER TABLE `seminar_leads`  ADD `user_panel` INT NOT NULL  AFTER `updated_at`;
ALTER TABLE `visit_leads`  ADD `user_panel` INT NOT NULL  AFTER `updated_at`;
ALTER TABLE `followup_leads`  ADD `user_panel` INT NOT NULL  AFTER `updated_at`;

ALTER TABLE `digital_leads` CHANGE `remark` `remark` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `seminar_leads` CHANGE `remark` `remark` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `visit_leads` CHANGE `remark` `remark` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `followup_leads` CHANGE `remark` `remark` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE `seminar_leads` ADD `leader_name` VARCHAR(100) NULL DEFAULT 'NA' AFTER `date`, ADD `place_seminar` VARCHAR(100) NULL DEFAULT 'NA' AFTER `leader_name`;

ALTER TABLE `property_allotments`  ADD `upgrade_history_id` INT NOT NULL  AFTER `user_key`;
ALTER TABLE `registry_forms`  ADD `property_allotment_id` INT NOT NULL  AFTER `user_key`;

ALTER TABLE `packages` ADD `level_limit` INT NOT NULL AFTER `tenure`;


ALTER TABLE `testimonials`  ADD `placement` INT NOT NULL DEFAULT '1'  AFTER `status`;


ALTER TABLE `admins`  ADD `mobile` INT NULL  AFTER `profile_image`,  ADD `master_password` VARCHAR(100) NULL  AFTER `mobile`;
ALTER TABLE `downloads`  ADD `status` INT NOT NULL DEFAULT '0'  AFTER `file`;


TRUNCATE `activities`;
TRUNCATE `assign_pins`;
TRUNCATE `payments`;
TRUNCATE `payouts`;
TRUNCATE `pins`;
TRUNCATE `pin_requests`;
TRUNCATE `upgrade_histories`;
TRUNCATE `user_bank_details`;
TRUNCATE `user_bank_detail_histories`;
TRUNCATE TABLE `user_monthly_salaries`;
TRUNCATE TABLE `roi_user_achievements`;
