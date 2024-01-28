<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125144813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, rue VARCHAR(255) NOT NULL, numero VARCHAR(10) DEFAULT NULL, complement_adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(200) NOT NULL, region VARCHAR(200) NOT NULL, pays VARCHAR(200) NOT NULL, telephone VARCHAR(15) NOT NULL, nom_client VARCHAR(255) NOT NULL, INDEX IDX_C35F0816A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name_categorie VARCHAR(100) NOT NULL, couverture VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dimensions (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, valeur_dimension VARCHAR(255) NOT NULL, INDEX IDX_E27D8BA5BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE epaisseurs (id INT AUTO_INCREMENT NOT NULL, valeur_epaisseur DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu_ventes (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE migration (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, epaisseur_id INT DEFAULT NULL, dimension_id INT DEFAULT NULL, reference VARCHAR(100) NOT NULL, designation VARCHAR(150) NOT NULL, INDEX IDX_B3BA5A5ABCF5E72D (categorie_id), INDEX IDX_B3BA5A5A35810E93 (epaisseur_id), INDEX IDX_B3BA5A5A277428AD (dimension_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, products_id INT NOT NULL, quantite DOUBLE PRECISION DEFAULT NULL, prix_unitaire DOUBLE PRECISION DEFAULT NULL, INDEX IDX_4B3656606C8A81A9 (products_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(150) NOT NULL, telephone VARCHAR(15) NOT NULL, email VARCHAR(100) DEFAULT NULL, naissance DATE DEFAULT NULL, type_user VARCHAR(50) NOT NULL, date_inscription DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE dimensions ADD CONSTRAINT FK_E27D8BA5BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5ABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A35810E93 FOREIGN KEY (epaisseur_id) REFERENCES epaisseurs (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A277428AD FOREIGN KEY (dimension_id) REFERENCES dimensions (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656606C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('ALTER TABLE dimensions DROP FOREIGN KEY FK_E27D8BA5BCF5E72D');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5ABCF5E72D');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A35810E93');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A277428AD');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656606C8A81A9');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE dimensions');
        $this->addSql('DROP TABLE epaisseurs');
        $this->addSql('DROP TABLE lieu_ventes');
        $this->addSql('DROP TABLE migration');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
