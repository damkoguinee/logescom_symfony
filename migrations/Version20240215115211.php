<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215115211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventaire (id INT AUTO_INCREMENT NOT NULL, inventaire_id INT NOT NULL, product_id INT NOT NULL, stock_id INT NOT NULL, personnel_id INT NOT NULL, quantite_init DOUBLE PRECISION DEFAULT NULL, quantite_inv DOUBLE PRECISION DEFAULT NULL, ecart DOUBLE PRECISION DEFAULT NULL, description VARCHAR(150) DEFAULT NULL, statut VARCHAR(15) NOT NULL, date_inventaire DATETIME NOT NULL, INDEX IDX_338920E0CE430A85 (inventaire_id), INDEX IDX_338920E04584665A (product_id), INDEX IDX_338920E0DCD6110 (stock_id), INDEX IDX_338920E01C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_inventaire (id INT AUTO_INCREMENT NOT NULL, personnel_id INT NOT NULL, lieu_vente_id INT NOT NULL, date_creation DATE NOT NULL, description VARCHAR(150) NOT NULL, INDEX IDX_2163BD761C109075 (personnel_id), INDEX IDX_2163BD76AA2B41DC (lieu_vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E0CE430A85 FOREIGN KEY (inventaire_id) REFERENCES liste_inventaire (id)');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E04584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E0DCD6110 FOREIGN KEY (stock_id) REFERENCES liste_stock (id)');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E01C109075 FOREIGN KEY (personnel_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liste_inventaire ADD CONSTRAINT FK_2163BD761C109075 FOREIGN KEY (personnel_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liste_inventaire ADD CONSTRAINT FK_2163BD76AA2B41DC FOREIGN KEY (lieu_vente_id) REFERENCES lieux_ventes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E0CE430A85');
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E04584665A');
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E0DCD6110');
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E01C109075');
        $this->addSql('ALTER TABLE liste_inventaire DROP FOREIGN KEY FK_2163BD761C109075');
        $this->addSql('ALTER TABLE liste_inventaire DROP FOREIGN KEY FK_2163BD76AA2B41DC');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE liste_inventaire');
    }
}
