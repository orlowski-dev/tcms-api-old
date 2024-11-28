CREATE OR REPLACE TABLE `users` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
	`name` VARCHAR(50) NOT NULL,
	`email` VARCHAR(150) NOT NULL UNIQUE,
	`password` VARCHAR(250) NOT NULL,
	`email_verified_at` DATETIME,
	`remember_token` VARCHAR(250),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_at` DATETIME,
	`role_id` BIGINT UNSIGNED NOT NULL,
	PRIMARY KEY(`id`)
);

CREATE INDEX `users_index_0`
ON `users` (`id`);
CREATE INDEX `users_index_1`
ON `users` (`email`);
CREATE OR REPLACE TABLE `profiles` (
	`user_id` BIGINT UNSIGNED NOT NULL UNIQUE,
	`phone_number` VARCHAR(31),
	`address` VARCHAR(60),
	`city` VARCHAR(50),
	`postal_code` VARCHAR(12),
	PRIMARY KEY(`user_id`)
);

CREATE INDEX `profiles_index_0`
ON `profiles` (`user_id`);
CREATE OR REPLACE TABLE `roles` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
	`name` VARCHAR(50) NOT NULL UNIQUE,
	`abilities` VARCHAR(255) NOT NULL,
	PRIMARY KEY(`id`)
);

CREATE INDEX `roles_2_index_0`
ON `roles` (`id`);
CREATE INDEX `roles_2_index_1`
ON `roles` (`name`);
ALTER TABLE `profiles`
ADD FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `roles`
ADD FOREIGN KEY(`id`) REFERENCES `users`(`role_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;