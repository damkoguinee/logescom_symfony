<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201143755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock ADD stock_produit_id INT NOT NULL, ADD prix_achat NUMERIC(12, 2) DEFAULT NULL, ADD prix_vente NUMERIC(12, 2) DEFAULT NULL, ADD date_peremption DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660A17D8957 FOREIGN KEY (stock_produit_id) REFERENCES liste_stock (id)');
        $this->addSql('CREATE INDEX IDX_4B365660A17D8957 ON stock (stock_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660A17D8957');
        $this->addSql('DROP INDEX IDX_4B365660A17D8957 ON stock');
        $this->addSql('ALTER TABLE stock DROP stock_produit_id, DROP prix_achat, DROP prix_vente, DROP date_peremption');
    }
}
