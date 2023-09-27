<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230925132001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_projet (client_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_5B3D71A19EB6921 (client_id), INDEX IDX_5B3D71AC18272 (projet_id), PRIMARY KEY(client_id, projet_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_projet ADD CONSTRAINT FK_5B3D71A19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_projet ADD CONSTRAINT FK_5B3D71AC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455C18272');
        $this->addSql('DROP INDEX IDX_C7440455C18272 ON client');
        $this->addSql('ALTER TABLE client DROP projet_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_projet DROP FOREIGN KEY FK_5B3D71A19EB6921');
        $this->addSql('ALTER TABLE client_projet DROP FOREIGN KEY FK_5B3D71AC18272');
        $this->addSql('DROP TABLE client_projet');
        $this->addSql('ALTER TABLE client ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C7440455C18272 ON client (projet_id)');
    }
}
