<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201141342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liste_stock (id INT AUTO_INCREMENT NOT NULL, lieu_vente_id INT NOT NULL, responsable_id INT NOT NULL, nom_stock VARCHAR(150) NOT NULL, adresse VARCHAR(255) NOT NULL, surface DOUBLE PRECISION DEFAULT NULL, nbre_pieces INT DEFAULT NULL, type VARCHAR(50) NOT NULL, INDEX IDX_54CD82CEAA2B41DC (lieu_vente_id), INDEX IDX_54CD82CE53C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liste_stock ADD CONSTRAINT FK_54CD82CEAA2B41DC FOREIGN KEY (lieu_vente_id) REFERENCES lieux_ventes (id)');
        $this->addSql('ALTER TABLE liste_stock ADD CONSTRAINT FK_54CD82CE53C59D72 FOREIGN KEY (responsable_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lieux_ventes ADD initial VARCHAR(10) DEFAULT NULL, ADD type_commerce VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD code_barre VARCHAR(255) DEFAULT NULL, ADD nbre_pieces DOUBLE PRECISION DEFAULT NULL, ADD nbre_paquets DOUBLE PRECISION DEFAULT NULL, ADD type_product VARCHAR(20) NOT NULL, ADD nbre_vente INT DEFAULT NULL, ADD statut VARCHAR(10) NOT NULL, ADD statut_comptable VARCHAR(10) NOT NULL, ADD tva DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_stock DROP FOREIGN KEY FK_54CD82CEAA2B41DC');
        $this->addSql('ALTER TABLE liste_stock DROP FOREIGN KEY FK_54CD82CE53C59D72');
        $this->addSql('DROP TABLE liste_stock');
        $this->addSql('ALTER TABLE lieux_ventes DROP initial, DROP type_commerce');
        $this->addSql('ALTER TABLE products DROP code_barre, DROP nbre_pieces, DROP nbre_paquets, DROP type_product, DROP nbre_vente, DROP statut, DROP statut_comptable, DROP tva');
    }
}
