<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240210211216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A277428AD FOREIGN KEY (dimension_id) REFERENCES dimensions (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A87998E FOREIGN KEY (origine_id) REFERENCES origine_produit (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AC54C8C93 FOREIGN KEY (type_id) REFERENCES type_produit (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A277428AD ON products (dimension_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A87998E ON products (origine_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AC54C8C93 ON products (type_id)');
        $this->addSql('ALTER TABLE products RENAME INDEX fk_b3ba5a5abcf5e72d TO IDX_B3BA5A5ABCF5E72D');
        $this->addSql('ALTER TABLE products RENAME INDEX fk_b3ba5a5a35810e93 TO IDX_B3BA5A5A35810E93');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A277428AD');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A87998E');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AC54C8C93');
        $this->addSql('DROP INDEX IDX_B3BA5A5A277428AD ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5A87998E ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5AC54C8C93 ON products');
        $this->addSql('ALTER TABLE products RENAME INDEX idx_b3ba5a5abcf5e72d TO FK_B3BA5A5ABCF5E72D');
        $this->addSql('ALTER TABLE products RENAME INDEX idx_b3ba5a5a35810e93 TO FK_B3BA5A5A35810E93');
    }
}
