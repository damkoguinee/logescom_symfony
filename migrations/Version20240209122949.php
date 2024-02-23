<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209122949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE migration');
        $this->addSql('ALTER TABLE categorie CHANGE img_produit img_produit JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD date_contact DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE migration (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie CHANGE img_produit img_produit LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE contact DROP date_contact');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
