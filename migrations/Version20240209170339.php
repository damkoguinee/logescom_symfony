<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209170339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE lieu_vente_id lieu_vente_id INT NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE ville ville VARCHAR(100) NOT NULL, CHANGE region region VARCHAR(100) NOT NULL, CHANGE pays pays VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE lieu_vente_id lieu_vente_id INT DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(100) DEFAULT NULL, CHANGE region region VARCHAR(100) DEFAULT NULL, CHANGE pays pays VARCHAR(100) DEFAULT NULL');
    }
}
