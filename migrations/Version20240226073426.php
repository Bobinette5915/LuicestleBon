<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226073426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE creneaux (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_livraison DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', creneaux_livrables TIME NOT NULL, INDEX IDX_77F13C6DC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE creneaux ADD CONSTRAINT FK_77F13C6DC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE creneaux DROP FOREIGN KEY FK_77F13C6DC6EE5C49');
        $this->addSql('DROP TABLE creneaux');
    }
}
