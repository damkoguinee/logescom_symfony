<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240126095226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lieux_ventes (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, gestionnaire_id INT NOT NULL, adresse VARCHAR(255) NOT NULL, pays VARCHAR(100) NOT NULL, region VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, telephone VARCHAR(20) NOT NULL, email VARCHAR(150) DEFAULT NULL, INDEX IDX_8FE8FCB7A4AEAFEA (entreprise_id), INDEX IDX_8FE8FCB76885AC1B (gestionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lieux_ventes ADD CONSTRAINT FK_8FE8FCB7A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE lieux_ventes ADD CONSTRAINT FK_8FE8FCB76885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lieux_ventes DROP FOREIGN KEY FK_8FE8FCB7A4AEAFEA');
        $this->addSql('ALTER TABLE lieux_ventes DROP FOREIGN KEY FK_8FE8FCB76885AC1B');
        $this->addSql('DROP TABLE lieux_ventes');
    }
}
