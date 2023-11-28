<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128103648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contenus (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, titre1 VARCHAR(255) NOT NULL, titre2 VARCHAR(255) DEFAULT NULL, titre3 VARCHAR(255) DEFAULT NULL, texte1 LONGTEXT DEFAULT NULL, texte2 LONGTEXT DEFAULT NULL, texte3 LONGTEXT DEFAULT NULL, date_creation DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenus_page (contenus_id INT NOT NULL, page_id INT NOT NULL, INDEX IDX_74F55C1042EAAF3 (contenus_id), INDEX IDX_74F55C10C4663E4 (page_id), PRIMARY KEY(contenus_id, page_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, format VARCHAR(255) DEFAULT NULL, hauteur INT DEFAULT NULL, largeur INT DEFAULT NULL, dimensions VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_contenus (image_id INT NOT NULL, contenus_id INT NOT NULL, INDEX IDX_2211AE9E3DA5256D (image_id), INDEX IDX_2211AE9E42EAAF3 (contenus_id), PRIMARY KEY(image_id, contenus_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, commentaires LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contenus_page ADD CONSTRAINT FK_74F55C1042EAAF3 FOREIGN KEY (contenus_id) REFERENCES contenus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contenus_page ADD CONSTRAINT FK_74F55C10C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_contenus ADD CONSTRAINT FK_2211AE9E3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_contenus ADD CONSTRAINT FK_2211AE9E42EAAF3 FOREIGN KEY (contenus_id) REFERENCES contenus (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenus_page DROP FOREIGN KEY FK_74F55C1042EAAF3');
        $this->addSql('ALTER TABLE contenus_page DROP FOREIGN KEY FK_74F55C10C4663E4');
        $this->addSql('ALTER TABLE image_contenus DROP FOREIGN KEY FK_2211AE9E3DA5256D');
        $this->addSql('ALTER TABLE image_contenus DROP FOREIGN KEY FK_2211AE9E42EAAF3');
        $this->addSql('DROP TABLE contenus');
        $this->addSql('DROP TABLE contenus_page');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_contenus');
        $this->addSql('DROP TABLE page');
    }
}
