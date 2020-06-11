<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611195440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, id_legume_id INT DEFAULT NULL, id_utilisateur_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, contenu VARCHAR(1000) DEFAULT NULL, INDEX IDX_67F068BCA5C43210 (id_legume_id), INDEX IDX_67F068BCC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, id_legume_id INT DEFAULT NULL, id_utilisateur_id INT DEFAULT NULL, INDEX IDX_8933C432A5C43210 (id_legume_id), INDEX IDX_8933C432C6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA5C43210 FOREIGN KEY (id_legume_id) REFERENCES legume (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432A5C43210 FOREIGN KEY (id_legume_id) REFERENCES legume (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE categorie ADD image VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(5000) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('ALTER TABLE categorie DROP image, DROP description');
    }
}
