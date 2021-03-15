<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210315010903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_alert (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, category_id INT NOT NULL, created_at DATETIME NOT NULL, valid_for INT NOT NULL, search_context VARCHAR(100) DEFAULT NULL, INDEX IDX_80E6CA2EA76ED395 (user_id), INDEX IDX_80E6CA2E12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_alert ADD CONSTRAINT FK_80E6CA2EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post_alert ADD CONSTRAINT FK_80E6CA2E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE post ADD county_id INT DEFAULT NULL, ADD address LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D85E73F45 FOREIGN KEY (county_id) REFERENCES county (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D85E73F45 ON post (county_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE post_alert');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D85E73F45');
        $this->addSql('DROP INDEX IDX_5A8A6C8D85E73F45 ON post');
        $this->addSql('ALTER TABLE post DROP county_id, DROP address');
    }
}
