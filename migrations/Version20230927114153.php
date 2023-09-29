<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927114153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, idprojet_id INT DEFAULT NULL, designation VARCHAR(50) NOT NULL, chemin VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) DEFAULT NULL, INDEX IDX_D8698A767EDA2B87 (idprojet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taches (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, descriptif VARCHAR(255) NOT NULL, debut DATE NOT NULL, fin DATE NOT NULL, cout INT DEFAULT NULL, INDEX IDX_3BF2CD98C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taches_partenaire (taches_id INT NOT NULL, partenaire_id INT NOT NULL, INDEX IDX_DF86623CB8A61670 (taches_id), INDEX IDX_DF86623C98DE13AC (partenaire_id), PRIMARY KEY(taches_id, partenaire_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A767EDA2B87 FOREIGN KEY (idprojet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE taches ADD CONSTRAINT FK_3BF2CD98C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE taches_partenaire ADD CONSTRAINT FK_DF86623CB8A61670 FOREIGN KEY (taches_id) REFERENCES taches (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taches_partenaire ADD CONSTRAINT FK_DF86623C98DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A767EDA2B87');
        $this->addSql('ALTER TABLE taches DROP FOREIGN KEY FK_3BF2CD98C18272');
        $this->addSql('ALTER TABLE taches_partenaire DROP FOREIGN KEY FK_DF86623CB8A61670');
        $this->addSql('ALTER TABLE taches_partenaire DROP FOREIGN KEY FK_DF86623C98DE13AC');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE taches');
        $this->addSql('DROP TABLE taches_partenaire');
    }
}
