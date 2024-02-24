CREATE DATABASE IF NOT EXISTS tca;

USE tca;

CREATE TABLE `task` (
    `id` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `finished` tinyint NOT NULL DEFAULT '1',
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;