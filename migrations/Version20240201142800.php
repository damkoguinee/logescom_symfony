<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201142800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP code_barre, DROP nbre_pieces, DROP nbre_paquets, DROP type_product, DROP nbre_vente, DROP statut, DROP statut_comptable, DROP tva');
        $this->addSql('ALTER TABLE stock RENAME INDEX idx_4b3656606c8a81a9 TO IDX_4B3656604584665A');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD code_barre VARCHAR(255) DEFAULT NULL, ADD nbre_pieces DOUBLE PRECISION DEFAULT NULL, ADD nbre_paquets DOUBLE PRECISION DEFAULT NULL, ADD type_product VARCHAR(20) NOT NULL, ADD nbre_vente INT DEFAULT NULL, ADD statut VARCHAR(10) NOT NULL, ADD statut_comptable VARCHAR(10) NOT NULL, ADD tva DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE stock RENAME INDEX idx_4b3656604584665a TO IDX_4B3656606C8A81A9');
    }
}
