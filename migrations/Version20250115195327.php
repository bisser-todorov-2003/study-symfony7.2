<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250115195327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F4161F55203D');
        $this->addSql('DROP INDEX IDX_BC91F4161F55203D ON resource');
        $this->addSql('ALTER TABLE resource CHANGE resource subject INT DEFAULT NULL');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F416FBCE3E7A FOREIGN KEY (subject) REFERENCES subject (id)');
        $this->addSql('CREATE INDEX IDX_BC91F416FBCE3E7A ON resource (subject)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F416FBCE3E7A');
        $this->addSql('DROP INDEX IDX_BC91F416FBCE3E7A ON resource');
        $this->addSql('ALTER TABLE resource CHANGE subject resource INT DEFAULT NULL');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F4161F55203D FOREIGN KEY (resource) REFERENCES subject (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BC91F4161F55203D ON resource (resource)');
    }
}
