<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229095913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_utilisateur INT NOT NULL, date_commande DATETIME NOT NULL, date_livraison DATETIME NOT NULL, heure_livraison DATETIME NOT NULL, prix DOUBLE PRECISION NOT NULL, adresse_livraison VARCHAR(255) NOT NULL, id_commande VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_details (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, id_formule_unique VARCHAR(255) NOT NULL, id_formule INT NOT NULL, nom_formule VARCHAR(255) NOT NULL, ingredient_supp1 VARCHAR(255) NOT NULL, ingredient_supp2 VARCHAR(255) NOT NULL, ingredient_supp3 VARCHAR(255) NOT NULL, ingredientsupp4 VARCHAR(255) NOT NULL, INDEX IDX_849D792A82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_details ADD CONSTRAINT FK_849D792A82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_details DROP FOREIGN KEY FK_849D792A82EA2E54');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_details');
    }
}
