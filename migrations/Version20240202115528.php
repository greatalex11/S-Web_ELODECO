<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202115528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, missiont1 VARCHAR(255) DEFAULT NULL, missiont2 VARCHAR(255) DEFAULT NULL, missionarg1 VARCHAR(255) DEFAULT NULL, missiontexte1 LONGTEXT DEFAULT NULL, missiont3 VARCHAR(255) DEFAULT NULL, missiont4 VARCHAR(255) DEFAULT NULL, missionarg3 VARCHAR(255) DEFAULT NULL, missionarg4 VARCHAR(255) DEFAULT NULL, missiontexte2 LONGTEXT DEFAULT NULL, missiontexte3 LONGTEXT DEFAULT NULL, missiont5 VARCHAR(255) DEFAULT NULL, missiont6 VARCHAR(255) DEFAULT NULL, liste JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mission');
    }
}
