<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205091854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mouvement_product (id INT AUTO_INCREMENT NOT NULL, stock_product_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_1C8AD1BAEBCD91F6 (stock_product_id), INDEX IDX_1C8AD1BA4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mouvement_product ADD CONSTRAINT FK_1C8AD1BAEBCD91F6 FOREIGN KEY (stock_product_id) REFERENCES liste_stock (id)');
        $this->addSql('ALTER TABLE mouvement_product ADD CONSTRAINT FK_1C8AD1BA4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE products ADD code_barre VARCHAR(255) DEFAULT NULL, ADD nbre_piece DOUBLE PRECISION DEFAULT NULL, ADD nbre_paquet DOUBLE PRECISION DEFAULT NULL, ADD type_produit VARCHAR(15) NOT NULL, ADD nbre_vente INT DEFAULT NULL, ADD statut VARCHAR(10) NOT NULL, ADD statut_comptable VARCHAR(10) NOT NULL, ADD tva DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement_product DROP FOREIGN KEY FK_1C8AD1BAEBCD91F6');
        $this->addSql('ALTER TABLE mouvement_product DROP FOREIGN KEY FK_1C8AD1BA4584665A');
        $this->addSql('DROP TABLE mouvement_product');
        $this->addSql('ALTER TABLE products DROP code_barre, DROP nbre_piece, DROP nbre_paquet, DROP type_produit, DROP nbre_vente, DROP statut, DROP statut_comptable, DROP tva');
    }
}
