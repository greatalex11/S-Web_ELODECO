<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207142624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE style_page DROP FOREIGN KEY FK_7B86C7D1BACD6074');
        $this->addSql('ALTER TABLE style_page DROP FOREIGN KEY FK_7B86C7D1C4663E4');
        $this->addSql('DROP TABLE style_page');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE style_page (style_id INT NOT NULL, page_id INT NOT NULL, INDEX IDX_7B86C7D1BACD6074 (style_id), INDEX IDX_7B86C7D1C4663E4 (page_id), PRIMARY KEY(style_id, page_id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE style_page ADD CONSTRAINT FK_7B86C7D1BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE style_page ADD CONSTRAINT FK_7B86C7D1C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
