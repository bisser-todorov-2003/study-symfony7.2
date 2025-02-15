<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250115172213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, resource INT DEFAULT NULL, name VARCHAR(512) NOT NULL, author VARCHAR(255) NOT NULL, link VARCHAR(1024) DEFAULT NULL, note LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, size INT NOT NULL, start_date DATETIME DEFAULT NULL, finish_date DATETIME DEFAULT NULL, progress INT DEFAULT NULL, INDEX IDX_BC91F4161F55203D (resource), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F4161F55203D FOREIGN KEY (resource) REFERENCES subject (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F4161F55203D');
        $this->addSql('DROP TABLE resource');
    }
}
