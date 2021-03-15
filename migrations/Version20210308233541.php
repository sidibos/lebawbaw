<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308233541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD assigned_role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DC9B9A23 FOREIGN KEY (assigned_role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DC9B9A23 ON user (assigned_role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DC9B9A23');
        $this->addSql('DROP INDEX IDX_8D93D649DC9B9A23 ON user');
        $this->addSql('ALTER TABLE user DROP assigned_role_id');
    }
}
