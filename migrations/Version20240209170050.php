<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209170050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type_client VARCHAR(50) NOT NULL, etat VARCHAR(15) NOT NULL, INDEX IDX_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, fonction VARCHAR(50) NOT NULL, document_identite VARCHAR(255) DEFAULT NULL, type_paie VARCHAR(50) NOT NULL, taux_horaire DOUBLE PRECISION DEFAULT NULL, salaire_base NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_A6BCF3DEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD lieu_vente_id INT DEFAULT NULL, ADD adresse VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(100) DEFAULT NULL, ADD region VARCHAR(100) DEFAULT NULL, ADD pays VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AA2B41DC FOREIGN KEY (lieu_vente_id) REFERENCES lieux_ventes (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649AA2B41DC ON user (lieu_vente_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEA76ED395');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AA2B41DC');
        $this->addSql('DROP INDEX IDX_8D93D649AA2B41DC ON user');
        $this->addSql('ALTER TABLE user DROP lieu_vente_id, DROP adresse, DROP ville, DROP region, DROP pays');
    }
}
