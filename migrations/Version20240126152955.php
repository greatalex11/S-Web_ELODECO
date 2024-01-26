<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240126152955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, titre1 VARCHAR(255) DEFAULT NULL, titre2 VARCHAR(255) DEFAULT NULL, attribut1 VARCHAR(255) DEFAULT NULL, attribut2 VARCHAR(255) DEFAULT NULL, attribut3 VARCHAR(255) DEFAULT NULL, texte1 LONGTEXT DEFAULT NULL, liste JSON DEFAULT NULL, texte2 LONGTEXT DEFAULT NULL, publier TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style_page (style_id INT NOT NULL, page_id INT NOT NULL, INDEX IDX_7B86C7D1BACD6074 (style_id), INDEX IDX_7B86C7D1C4663E4 (page_id), PRIMARY KEY(style_id, page_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style_image (style_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_FE84AA4BACD6074 (style_id), INDEX IDX_FE84AA43DA5256D (image_id), PRIMARY KEY(style_id, image_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE style_page ADD CONSTRAINT FK_7B86C7D1BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE style_page ADD CONSTRAINT FK_7B86C7D1C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE style_image ADD CONSTRAINT FK_FE84AA4BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE style_image ADD CONSTRAINT FK_FE84AA43DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE style_page DROP FOREIGN KEY FK_7B86C7D1BACD6074');
        $this->addSql('ALTER TABLE style_page DROP FOREIGN KEY FK_7B86C7D1C4663E4');
        $this->addSql('ALTER TABLE style_image DROP FOREIGN KEY FK_FE84AA4BACD6074');
        $this->addSql('ALTER TABLE style_image DROP FOREIGN KEY FK_FE84AA43DA5256D');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE style_page');
        $this->addSql('DROP TABLE style_image');
    }
}
