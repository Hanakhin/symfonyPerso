<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240713101321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention CHANGE is_urgent is_urgent TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE rapport ADD user_id INT DEFAULT NULL, ADD intervention_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C8EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('CREATE INDEX IDX_BE34A09CA76ED395 ON rapport (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE34A09C8EAE3863 ON rapport (intervention_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09CA76ED395');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C8EAE3863');
        $this->addSql('DROP INDEX IDX_BE34A09CA76ED395 ON rapport');
        $this->addSql('DROP INDEX UNIQ_BE34A09C8EAE3863 ON rapport');
        $this->addSql('ALTER TABLE rapport DROP user_id, DROP intervention_id');
        $this->addSql('ALTER TABLE intervention CHANGE is_urgent is_urgent TINYINT(1) DEFAULT 0 NOT NULL');
    }
}
