<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240711172354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adress (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE extincteur (id INT AUTO_INCREMENT NOT NULL, date_fabrication DATE NOT NULL, date_maintenance DATE NOT NULL, is_active TINYINT(1) NOT NULL, extincteur_type_id_id INT DEFAULT NULL, INDEX IDX_36590C7C3419BCA (extincteur_type_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE extincteur_intervention (extincteur_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_4DBCC783BE385A3B (extincteur_id), INDEX IDX_4DBCC7838EAE3863 (intervention_id), PRIMARY KEY(extincteur_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE extincteur_user (extincteur_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_53F22935BE385A3B (extincteur_id), INDEX IDX_53F22935A76ED395 (user_id), PRIMARY KEY(extincteur_id, user_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE extincteur_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, commentaire VARCHAR(255) NOT NULL, user_id_id INT DEFAULT NULL, intervention_id_id INT DEFAULT NULL, INDEX IDX_D22944589D86650F (user_id_id), UNIQUE INDEX UNIQ_D2294458A2182D3 (intervention_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, date_creation DATE NOT NULL, date_intervention DATE NOT NULL, is_urgent TINYINT(1) NOT NULL, status_id_id INT DEFAULT NULL, rapport_id_id INT DEFAULT NULL, type_intervention_id_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_D11814AB881ECFA7 (status_id_id), UNIQUE INDEX UNIQ_D11814AB5F768789 (rapport_id_id), INDEX IDX_D11814AB6D40F903 (type_intervention_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE intervention_user (intervention_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_822CCE8B8EAE3863 (intervention_id), INDEX IDX_822CCE8BA76ED395 (user_id), PRIMARY KEY(intervention_id, user_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE rapport (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE type_intervention (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, adress_id_id INT DEFAULT NULL, INDEX IDX_8D93D64977861D51 (adress_id_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE extincteur ADD CONSTRAINT FK_36590C7C3419BCA FOREIGN KEY (extincteur_type_id_id) REFERENCES extincteur_type (id)');
        $this->addSql('ALTER TABLE extincteur_intervention ADD CONSTRAINT FK_4DBCC783BE385A3B FOREIGN KEY (extincteur_id) REFERENCES extincteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE extincteur_intervention ADD CONSTRAINT FK_4DBCC7838EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE extincteur_user ADD CONSTRAINT FK_53F22935BE385A3B FOREIGN KEY (extincteur_id) REFERENCES extincteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE extincteur_user ADD CONSTRAINT FK_53F22935A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D22944589D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458A2182D3 FOREIGN KEY (intervention_id_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB881ECFA7 FOREIGN KEY (status_id_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB5F768789 FOREIGN KEY (rapport_id_id) REFERENCES rapport (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB6D40F903 FOREIGN KEY (type_intervention_id_id) REFERENCES type_intervention (id)');
        $this->addSql('ALTER TABLE intervention_user ADD CONSTRAINT FK_822CCE8B8EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_user ADD CONSTRAINT FK_822CCE8BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64977861D51 FOREIGN KEY (adress_id_id) REFERENCES adress (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE extincteur DROP FOREIGN KEY FK_36590C7C3419BCA');
        $this->addSql('ALTER TABLE extincteur_intervention DROP FOREIGN KEY FK_4DBCC783BE385A3B');
        $this->addSql('ALTER TABLE extincteur_intervention DROP FOREIGN KEY FK_4DBCC7838EAE3863');
        $this->addSql('ALTER TABLE extincteur_user DROP FOREIGN KEY FK_53F22935BE385A3B');
        $this->addSql('ALTER TABLE extincteur_user DROP FOREIGN KEY FK_53F22935A76ED395');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D22944589D86650F');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458A2182D3');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB881ECFA7');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB5F768789');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB6D40F903');
        $this->addSql('ALTER TABLE intervention_user DROP FOREIGN KEY FK_822CCE8B8EAE3863');
        $this->addSql('ALTER TABLE intervention_user DROP FOREIGN KEY FK_822CCE8BA76ED395');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64977861D51');
        $this->addSql('DROP TABLE adress');
        $this->addSql('DROP TABLE extincteur');
        $this->addSql('DROP TABLE extincteur_intervention');
        $this->addSql('DROP TABLE extincteur_user');
        $this->addSql('DROP TABLE extincteur_type');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE intervention_user');
        $this->addSql('DROP TABLE rapport');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type_intervention');
        $this->addSql('DROP TABLE `user`');
    }
}
