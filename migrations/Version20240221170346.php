<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221170346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anomalie_produit (id INT AUTO_INCREMENT NOT NULL, stock_id INT NOT NULL, product_id INT NOT NULL, personnel_id INT NOT NULL, inventaire_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, prix_revient NUMERIC(12, 2) DEFAULT NULL, date_anomalie DATE NOT NULL, INDEX IDX_ADB996D0DCD6110 (stock_id), INDEX IDX_ADB996D04584665A (product_id), INDEX IDX_ADB996D01C109075 (personnel_id), INDEX IDX_ADB996D0CE430A85 (inventaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anomalie_produit ADD CONSTRAINT FK_ADB996D0DCD6110 FOREIGN KEY (stock_id) REFERENCES liste_stock (id)');
        $this->addSql('ALTER TABLE anomalie_produit ADD CONSTRAINT FK_ADB996D04584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE anomalie_produit ADD CONSTRAINT FK_ADB996D01C109075 FOREIGN KEY (personnel_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE anomalie_produit ADD CONSTRAINT FK_ADB996D0CE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anomalie_produit DROP FOREIGN KEY FK_ADB996D0DCD6110');
        $this->addSql('ALTER TABLE anomalie_produit DROP FOREIGN KEY FK_ADB996D04584665A');
        $this->addSql('ALTER TABLE anomalie_produit DROP FOREIGN KEY FK_ADB996D01C109075');
        $this->addSql('ALTER TABLE anomalie_produit DROP FOREIGN KEY FK_ADB996D0CE430A85');
        $this->addSql('DROP TABLE anomalie_produit');
    }
}
