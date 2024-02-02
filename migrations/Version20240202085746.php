<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202085746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE about (id INT AUTO_INCREMENT NOT NULL, visiot1 VARCHAR(255) DEFAULT NULL, visiot2 VARCHAR(255) DEFAULT NULL, visioarg1 VARCHAR(255) DEFAULT NULL, visioarg2 VARCHAR(255) DEFAULT NULL, visioarg3 VARCHAR(255) DEFAULT NULL, visioarg4 VARCHAR(255) DEFAULT NULL, visiot3 VARCHAR(255) DEFAULT NULL, visiotexte1 LONGTEXT DEFAULT NULL, visiotexte2 LONGTEXT DEFAULT NULL, visiochiffre1 INT DEFAULT NULL, visiochiffre2 INT DEFAULT NULL, expertt1 VARCHAR(255) DEFAULT NULL, expertt2 VARCHAR(255) DEFAULT NULL, expertt3 VARCHAR(255) DEFAULT NULL, expertt4 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE about_image (about_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_AE454080D087DB59 (about_id), INDEX IDX_AE4540803DA5256D (image_id), PRIMARY KEY(about_id, image_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE about_image ADD CONSTRAINT FK_AE454080D087DB59 FOREIGN KEY (about_id) REFERENCES about (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE about_image ADD CONSTRAINT FK_AE4540803DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE about_image DROP FOREIGN KEY FK_AE454080D087DB59');
        $this->addSql('ALTER TABLE about_image DROP FOREIGN KEY FK_AE4540803DA5256D');
        $this->addSql('DROP TABLE about');
        $this->addSql('DROP TABLE about_image');
    }
}
