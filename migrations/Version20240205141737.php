<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205141737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liaison_produit (id INT AUTO_INCREMENT NOT NULL, produit1_id INT NOT NULL, produit2_id INT NOT NULL, type VARCHAR(10) NOT NULL, INDEX IDX_7F4F29C1FC0C3279 (produit1_id), INDEX IDX_7F4F29C1EEB99D97 (produit2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liaison_produit ADD CONSTRAINT FK_7F4F29C1FC0C3279 FOREIGN KEY (produit1_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE liaison_produit ADD CONSTRAINT FK_7F4F29C1EEB99D97 FOREIGN KEY (produit2_id) REFERENCES products (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liaison_produit DROP FOREIGN KEY FK_7F4F29C1FC0C3279');
        $this->addSql('ALTER TABLE liaison_produit DROP FOREIGN KEY FK_7F4F29C1EEB99D97');
        $this->addSql('DROP TABLE liaison_produit');
    }
}
