<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202115925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mission_image (mission_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_55AB5B62BE6CAE90 (mission_id), INDEX IDX_55AB5B623DA5256D (image_id), PRIMARY KEY(mission_id, image_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission_image ADD CONSTRAINT FK_55AB5B62BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_image ADD CONSTRAINT FK_55AB5B623DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission_image DROP FOREIGN KEY FK_55AB5B62BE6CAE90');
        $this->addSql('ALTER TABLE mission_image DROP FOREIGN KEY FK_55AB5B623DA5256D');
        $this->addSql('DROP TABLE mission_image');
    }
}
