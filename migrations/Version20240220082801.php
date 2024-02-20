<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220082801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boxs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, soustitre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boxs_ingredients (boxs_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_F4ECBD2851CF8763 (boxs_id), INDEX IDX_F4ECBD283EC4DCE (ingredients_id), PRIMARY KEY(boxs_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boxs_ingredients ADD CONSTRAINT FK_F4ECBD2851CF8763 FOREIGN KEY (boxs_id) REFERENCES boxs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boxs_ingredients ADD CONSTRAINT FK_F4ECBD283EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse ADD user_id INT NOT NULL, ADD nomadresse VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD postal VARCHAR(255) NOT NULL, ADD pays VARCHAR(255) NOT NULL, ADD tel VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C35F0816A76ED395 ON adresse (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boxs_ingredients DROP FOREIGN KEY FK_F4ECBD2851CF8763');
        $this->addSql('ALTER TABLE boxs_ingredients DROP FOREIGN KEY FK_F4ECBD283EC4DCE');
        $this->addSql('DROP TABLE boxs');
        $this->addSql('DROP TABLE boxs_ingredients');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('DROP INDEX IDX_C35F0816A76ED395 ON adresse');
        $this->addSql('ALTER TABLE adresse DROP user_id, DROP nomadresse, DROP nom, DROP prenom, DROP adresse, DROP ville, DROP postal, DROP pays, DROP tel');
    }
}
