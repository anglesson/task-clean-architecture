<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424050249 extends AbstractMigration
{
    public function getDescription(): string {
        return '';
    }

    public function up(Schema $schema): void {
        $this->addSql("
            CREATE TABLE `list` (
                `id` VARCHAR(255) NOT NULL,
                `name` VARCHAR(255) NOT NULL,
                `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
        ");
        $this->addSql("ALTER TABLE `task` ADD `list_id` varchar(255);");
        $this->addSql("ALTER TABLE `task` ADD CONSTRAINT `fk_task_list` FOREIGN KEY (`list_id`) REFERENCES `list`(`id`);");
    }

    public function down(Schema $schema): void {
        $this->addSql("ALTER TABLE `task` DROP FOREIGN KEY `fk_task_list`;");
        $this->addSql("ALTER TABLE `task` DROP COLUMN `list_id`;");
        $this->addSql("DROP TABLE `list`");
    }
}
