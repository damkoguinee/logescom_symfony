<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131171320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dimensions ADD unite VARCHAR(15) DEFAULT NULL');
        $this->addSql('ALTER TABLE epaisseurs ADD categorie_id INT DEFAULT NULL, ADD unite VARCHAR(15) DEFAULT NULL');
        $this->addSql('ALTER TABLE epaisseurs ADD CONSTRAINT FK_9F8BBE8CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_9F8BBE8CBCF5E72D ON epaisseurs (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dimensions DROP unite');
        $this->addSql('ALTER TABLE epaisseurs DROP FOREIGN KEY FK_9F8BBE8CBCF5E72D');
        $this->addSql('DROP INDEX IDX_9F8BBE8CBCF5E72D ON epaisseurs');
        $this->addSql('ALTER TABLE epaisseurs DROP categorie_id, DROP unite');
    }
}
