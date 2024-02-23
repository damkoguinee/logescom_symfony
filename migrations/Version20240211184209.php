<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240211184209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products CHANGE categorie_id categorie_id INT NOT NULL, CHANGE reference reference VARCHAR(100) NOT NULL, CHANGE designation designation VARCHAR(150) NOT NULL, CHANGE code_barre code_barre VARCHAR(255) DEFAULT NULL, CHANGE type_produit type_produit VARCHAR(15) NOT NULL, CHANGE statut statut VARCHAR(10) NOT NULL, CHANGE statut_comptable statut_comptable VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5ABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A35810E93 FOREIGN KEY (epaisseur_id) REFERENCES epaisseurs (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A277428AD FOREIGN KEY (dimension_id) REFERENCES dimensions (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A87998E FOREIGN KEY (origine_id) REFERENCES origine_produit (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AC54C8C93 FOREIGN KEY (type_id) REFERENCES type_produit (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5ABCF5E72D ON products (categorie_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A35810E93 ON products (epaisseur_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A277428AD ON products (dimension_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A87998E ON products (origine_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AC54C8C93 ON products (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5ABCF5E72D');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A35810E93');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A277428AD');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A87998E');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AC54C8C93');
        $this->addSql('DROP INDEX IDX_B3BA5A5ABCF5E72D ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5A35810E93 ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5A277428AD ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5A87998E ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5AC54C8C93 ON products');
        $this->addSql('ALTER TABLE products CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE reference reference VARCHAR(100) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE designation designation VARCHAR(150) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE code_barre code_barre VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE type_produit type_produit VARCHAR(15) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE statut statut VARCHAR(10) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE statut_comptable statut_comptable VARCHAR(10) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
    }
}
