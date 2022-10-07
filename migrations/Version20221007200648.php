<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007200648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batiment ADD cite_id INT NOT NULL');
        $this->addSql('ALTER TABLE batiment ADD CONSTRAINT FK_F5FAB00C91638A88 FOREIGN KEY (cite_id) REFERENCES cite (id)');
        $this->addSql('CREATE INDEX IDX_F5FAB00C91638A88 ON batiment (cite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batiment DROP FOREIGN KEY FK_F5FAB00C91638A88');
        $this->addSql('DROP INDEX IDX_F5FAB00C91638A88 ON batiment');
        $this->addSql('ALTER TABLE batiment DROP cite_id');
    }
}
