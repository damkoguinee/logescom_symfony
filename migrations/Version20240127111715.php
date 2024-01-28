<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127111715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD origine_id INT DEFAULT NULL, ADD type_id INT DEFAULT NULL, ADD prix_vente NUMERIC(15, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A87998E FOREIGN KEY (origine_id) REFERENCES origine_produit (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AC54C8C93 FOREIGN KEY (type_id) REFERENCES type_produit (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A87998E ON products (origine_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AC54C8C93 ON products (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A87998E');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AC54C8C93');
        $this->addSql('DROP INDEX IDX_B3BA5A5A87998E ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5AC54C8C93 ON products');
        $this->addSql('ALTER TABLE products DROP origine_id, DROP type_id, DROP prix_vente');
    }
}
