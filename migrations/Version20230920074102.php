<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920074102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, INDEX IDX_C7440455C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conseil (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, short_descriptif VARCHAR(255) NOT NULL, descriptif LONGTEXT NOT NULL, illustration VARCHAR(255) NOT NULL, video VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail (id INT AUTO_INCREMENT NOT NULL, objet VARCHAR(255) NOT NULL, corps LONGTEXT NOT NULL, date_expe DATE DEFAULT NULL, piece_jointe VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_client (mail_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_1A7DBB3EC8776F01 (mail_id), INDEX IDX_1A7DBB3E19EB6921 (client_id), PRIMARY KEY(mail_id, client_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_partenaire (mail_id INT NOT NULL, partenaire_id INT NOT NULL, INDEX IDX_E63C498FC8776F01 (mail_id), INDEX IDX_E63C498F98DE13AC (partenaire_id), PRIMARY KEY(mail_id, partenaire_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modalite_contact (id INT AUTO_INCREMENT NOT NULL, moyen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modamite_contact (id INT AUTO_INCREMENT NOT NULL, mail_choice_id INT DEFAULT NULL, INDEX IDX_A528FD62E15C78B2 (mail_choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nature_relances (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, entreprise VARCHAR(255) NOT NULL, raison_sociale VARCHAR(255) NOT NULL, siret INT NOT NULL, nom_contact VARCHAR(255) NOT NULL, prenom_contact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, debut DATE NOT NULL, date_fin DATE NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet_partenaire (projet_id INT NOT NULL, partenaire_id INT NOT NULL, INDEX IDX_B3624B59C18272 (projet_id), INDEX IDX_B3624B5998DE13AC (partenaire_id), PRIMARY KEY(projet_id, partenaire_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relance (id INT AUTO_INCREMENT NOT NULL, nature_id INT NOT NULL, modalite_id INT NOT NULL, date_relance DATE NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_50BBC1263BCB2E4B (nature_id), INDEX IDX_50BBC12637A260BC (modalite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, partenaire_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, annotation LONGTEXT NOT NULL, telephone INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64919EB6921 (client_id), UNIQUE INDEX UNIQ_8D93D64998DE13AC (partenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE mail_client ADD CONSTRAINT FK_1A7DBB3EC8776F01 FOREIGN KEY (mail_id) REFERENCES mail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mail_client ADD CONSTRAINT FK_1A7DBB3E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mail_partenaire ADD CONSTRAINT FK_E63C498FC8776F01 FOREIGN KEY (mail_id) REFERENCES mail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mail_partenaire ADD CONSTRAINT FK_E63C498F98DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modamite_contact ADD CONSTRAINT FK_A528FD62E15C78B2 FOREIGN KEY (mail_choice_id) REFERENCES mail (id)');
        $this->addSql('ALTER TABLE projet_partenaire ADD CONSTRAINT FK_B3624B59C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_partenaire ADD CONSTRAINT FK_B3624B5998DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relance ADD CONSTRAINT FK_50BBC1263BCB2E4B FOREIGN KEY (nature_id) REFERENCES nature_relances (id)');
        $this->addSql('ALTER TABLE relance ADD CONSTRAINT FK_50BBC12637A260BC FOREIGN KEY (modalite_id) REFERENCES modalite_contact (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64998DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455C18272');
        $this->addSql('ALTER TABLE mail_client DROP FOREIGN KEY FK_1A7DBB3EC8776F01');
        $this->addSql('ALTER TABLE mail_client DROP FOREIGN KEY FK_1A7DBB3E19EB6921');
        $this->addSql('ALTER TABLE mail_partenaire DROP FOREIGN KEY FK_E63C498FC8776F01');
        $this->addSql('ALTER TABLE mail_partenaire DROP FOREIGN KEY FK_E63C498F98DE13AC');
        $this->addSql('ALTER TABLE modamite_contact DROP FOREIGN KEY FK_A528FD62E15C78B2');
        $this->addSql('ALTER TABLE projet_partenaire DROP FOREIGN KEY FK_B3624B59C18272');
        $this->addSql('ALTER TABLE projet_partenaire DROP FOREIGN KEY FK_B3624B5998DE13AC');
        $this->addSql('ALTER TABLE relance DROP FOREIGN KEY FK_50BBC1263BCB2E4B');
        $this->addSql('ALTER TABLE relance DROP FOREIGN KEY FK_50BBC12637A260BC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64919EB6921');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64998DE13AC');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE conseil');
        $this->addSql('DROP TABLE mail');
        $this->addSql('DROP TABLE mail_client');
        $this->addSql('DROP TABLE mail_partenaire');
        $this->addSql('DROP TABLE modalite_contact');
        $this->addSql('DROP TABLE modamite_contact');
        $this->addSql('DROP TABLE nature_relances');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE projet_partenaire');
        $this->addSql('DROP TABLE relance');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
