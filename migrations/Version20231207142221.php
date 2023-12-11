<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207142221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DFF98F144A');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DFF98F144A FOREIGN KEY (logo_id) REFERENCES image (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DFF98F144A');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DFF98F144A FOREIGN KEY (logo_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
