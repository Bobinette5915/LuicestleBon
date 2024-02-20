<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220082943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boxs ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE boxs ADD CONSTRAINT FK_DD0ABFF1BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_DD0ABFF1BCF5E72D ON boxs (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boxs DROP FOREIGN KEY FK_DD0ABFF1BCF5E72D');
        $this->addSql('DROP INDEX IDX_DD0ABFF1BCF5E72D ON boxs');
        $this->addSql('ALTER TABLE boxs DROP categorie_id');
    }
}
