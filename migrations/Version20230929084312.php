<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929084312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE date_naissance date_naissance DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE partenaire CHANGE entreprise entreprise VARCHAR(255) DEFAULT NULL, CHANGE raison_sociale raison_sociale VARCHAR(255) DEFAULT NULL, CHANGE siret siret INT DEFAULT NULL, CHANGE nom_contact nom_contact VARCHAR(255) DEFAULT NULL, CHANGE prenom_contact prenom_contact VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE annotation annotation LONGTEXT DEFAULT NULL, CHANGE telephone telephone INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE code_postal code_postal INT NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE annotation annotation LONGTEXT NOT NULL, CHANGE telephone telephone INT NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE date_naissance date_naissance DATE NOT NULL');
        $this->addSql('ALTER TABLE partenaire CHANGE entreprise entreprise VARCHAR(255) NOT NULL, CHANGE raison_sociale raison_sociale VARCHAR(255) NOT NULL, CHANGE siret siret INT NOT NULL, CHANGE nom_contact nom_contact VARCHAR(255) NOT NULL, CHANGE prenom_contact prenom_contact VARCHAR(255) NOT NULL');
    }
}
