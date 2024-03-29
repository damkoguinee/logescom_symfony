<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221195553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement_product ADD anomalie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mouvement_product ADD CONSTRAINT FK_1C8AD1BAAEEAB197 FOREIGN KEY (anomalie_id) REFERENCES anomalie_produit (id)');
        $this->addSql('CREATE INDEX IDX_1C8AD1BAAEEAB197 ON mouvement_product (anomalie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement_product DROP FOREIGN KEY FK_1C8AD1BAAEEAB197');
        $this->addSql('DROP INDEX IDX_1C8AD1BAAEEAB197 ON mouvement_product');
        $this->addSql('ALTER TABLE mouvement_product DROP anomalie_id');
    }
}
