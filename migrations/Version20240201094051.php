<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201094051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet_image (projet_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_6E9BEBE9C18272 (projet_id), INDEX IDX_6E9BEBE93DA5256D (image_id), PRIMARY KEY(projet_id, image_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet_image ADD CONSTRAINT FK_6E9BEBE9C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_image ADD CONSTRAINT FK_6E9BEBE93DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet ADD slug VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet_image DROP FOREIGN KEY FK_6E9BEBE9C18272');
        $this->addSql('ALTER TABLE projet_image DROP FOREIGN KEY FK_6E9BEBE93DA5256D');
        $this->addSql('DROP TABLE projet_image');
        $this->addSql('ALTER TABLE projet DROP slug');
    }
}
