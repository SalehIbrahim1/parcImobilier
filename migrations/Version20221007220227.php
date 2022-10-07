<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007220227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE locataire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE DEFAULT NULL, lieu_de_naissance VARCHAR(255) DEFAULT NULL, nom_du_pere VARCHAR(255) DEFAULT NULL, prenom_du_pere VARCHAR(255) DEFAULT NULL, nom_de_la_mere VARCHAR(255) DEFAULT NULL, prenom_de_la_mere VARCHAR(255) DEFAULT NULL, situation_familliale VARCHAR(255) DEFAULT NULL, nombre_enfant INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE locataire');
    }
}
