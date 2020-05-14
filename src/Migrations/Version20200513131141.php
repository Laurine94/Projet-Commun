<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513131141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE legume_legume');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE legume_legume (legume_source INT NOT NULL, legume_target INT NOT NULL, INDEX IDX_955D700A4CB17CFA (legume_source), INDEX IDX_955D700A55542C75 (legume_target), PRIMARY KEY(legume_source, legume_target)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE legume_legume ADD CONSTRAINT FK_955D700A4CB17CFA FOREIGN KEY (legume_source) REFERENCES legume (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE legume_legume ADD CONSTRAINT FK_955D700A55542C75 FOREIGN KEY (legume_target) REFERENCES legume (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
