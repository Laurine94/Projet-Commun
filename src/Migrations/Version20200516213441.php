<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516213441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE legume_bonne_asso');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE legume_bonne_asso (id_legume1 INT NOT NULL, id_legume2 INT NOT NULL, INDEX IDX_415A7AEB2976F22E (id_legume1), INDEX IDX_415A7AEBB07FA394 (id_legume2), PRIMARY KEY(id_legume1, id_legume2)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE legume_bonne_asso ADD CONSTRAINT FK_415A7AEB2976F22E FOREIGN KEY (id_legume1) REFERENCES legume (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE legume_bonne_asso ADD CONSTRAINT FK_415A7AEBB07FA394 FOREIGN KEY (id_legume2) REFERENCES legume (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
