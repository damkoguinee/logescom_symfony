<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218112627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD rattachement_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404558E780FD FOREIGN KEY (rattachement_id) REFERENCES lieux_ventes (id)');
        $this->addSql('CREATE INDEX IDX_C74404558E780FD ON client (rattachement_id)');
        $this->addSql('ALTER TABLE mouvement_product ADD lieu_vente_id INT NOT NULL, ADD personnel_id INT NOT NULL, ADD client_id INT DEFAULT NULL, ADD inventaire_id INT DEFAULT NULL, ADD quantite DOUBLE PRECISION DEFAULT NULL, ADD date_operation DATETIME NOT NULL, ADD origine VARCHAR(100) NOT NULL, ADD description VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE mouvement_product ADD CONSTRAINT FK_1C8AD1BAAA2B41DC FOREIGN KEY (lieu_vente_id) REFERENCES lieux_ventes (id)');
        $this->addSql('ALTER TABLE mouvement_product ADD CONSTRAINT FK_1C8AD1BA1C109075 FOREIGN KEY (personnel_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mouvement_product ADD CONSTRAINT FK_1C8AD1BA19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mouvement_product ADD CONSTRAINT FK_1C8AD1BACE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('CREATE INDEX IDX_1C8AD1BAAA2B41DC ON mouvement_product (lieu_vente_id)');
        $this->addSql('CREATE INDEX IDX_1C8AD1BA1C109075 ON mouvement_product (personnel_id)');
        $this->addSql('CREATE INDEX IDX_1C8AD1BA19EB6921 ON mouvement_product (client_id)');
        $this->addSql('CREATE INDEX IDX_1C8AD1BACE430A85 ON mouvement_product (inventaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404558E780FD');
        $this->addSql('DROP INDEX IDX_C74404558E780FD ON client');
        $this->addSql('ALTER TABLE client DROP rattachement_id');
        $this->addSql('ALTER TABLE mouvement_product DROP FOREIGN KEY FK_1C8AD1BAAA2B41DC');
        $this->addSql('ALTER TABLE mouvement_product DROP FOREIGN KEY FK_1C8AD1BA1C109075');
        $this->addSql('ALTER TABLE mouvement_product DROP FOREIGN KEY FK_1C8AD1BA19EB6921');
        $this->addSql('ALTER TABLE mouvement_product DROP FOREIGN KEY FK_1C8AD1BACE430A85');
        $this->addSql('DROP INDEX IDX_1C8AD1BAAA2B41DC ON mouvement_product');
        $this->addSql('DROP INDEX IDX_1C8AD1BA1C109075 ON mouvement_product');
        $this->addSql('DROP INDEX IDX_1C8AD1BA19EB6921 ON mouvement_product');
        $this->addSql('DROP INDEX IDX_1C8AD1BACE430A85 ON mouvement_product');
        $this->addSql('ALTER TABLE mouvement_product DROP lieu_vente_id, DROP personnel_id, DROP client_id, DROP inventaire_id, DROP quantite, DROP date_operation, DROP origine, DROP description');
    }
}
