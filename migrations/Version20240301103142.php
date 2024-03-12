<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240301103142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_details CHANGE ingredient_supp1 ingredient_supp1 VARCHAR(255) DEFAULT NULL, CHANGE ingredient_supp2 ingredient_supp2 VARCHAR(255) DEFAULT NULL, CHANGE ingredient_supp3 ingredient_supp3 VARCHAR(255) DEFAULT NULL, CHANGE ingredient_supp4 ingredient_supp4 VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_details CHANGE ingredient_supp1 ingredient_supp1 VARCHAR(255) NOT NULL, CHANGE ingredient_supp2 ingredient_supp2 VARCHAR(255) NOT NULL, CHANGE ingredient_supp3 ingredient_supp3 VARCHAR(255) NOT NULL, CHANGE ingredient_supp4 ingredient_supp4 VARCHAR(255) NOT NULL');
    }
}
