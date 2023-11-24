<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124092916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artisan (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, raison_sociale VARCHAR(50) DEFAULT NULL, nom_etablissement VARCHAR(50) DEFAULT NULL, siret VARCHAR(50) DEFAULT NULL, nom_gerant VARCHAR(50) DEFAULT NULL, prenom_gerant VARCHAR(50) DEFAULT NULL, date_naissance DATE DEFAULT NULL, numero_rue VARCHAR(50) DEFAULT NULL, code_postal VARCHAR(50) DEFAULT NULL, localite VARCHAR(50) DEFAULT NULL, tel_fixe VARCHAR(50) DEFAULT NULL, tel_portable VARCHAR(50) DEFAULT NULL, fax VARCHAR(50) DEFAULT NULL, note_globale INT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_3C600AD3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, numero_rue VARCHAR(255) DEFAULT NULL, rue VARCHAR(50) DEFAULT NULL, code_postal VARCHAR(50) DEFAULT NULL, localite VARCHAR(50) DEFAULT NULL, tel_fix VARCHAR(50) DEFAULT NULL, tel_portable VARCHAR(50) DEFAULT NULL, date_naissance DATE DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artisan ADD CONSTRAINT FK_3C600AD3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisan DROP FOREIGN KEY FK_3C600AD3A76ED395');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('DROP TABLE artisan');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
