<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423000518 extends AbstractMigration
{
    public function getDescription(): string {
        return 'Create Task Table';
    }

    public function up(Schema $schema): void {
        $this->addSql("
            CREATE TABLE `task` (
                `id` VARCHAR(255) NOT NULL,
                `description` VARCHAR(255) NOT NULL,
                `finished` tinyint NOT NULL DEFAULT '0',
                `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
        ");
    }

    public function down(Schema $schema): void {
        $schema->dropTable('task');
    }
}
