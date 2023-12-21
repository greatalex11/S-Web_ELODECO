<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221132018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documents_artisan DROP FOREIGN KEY FK_A32C6B405ED3C7B7');
        $this->addSql('ALTER TABLE documents_artisan DROP FOREIGN KEY FK_A32C6B405F0F2752');
        $this->addSql('ALTER TABLE documents_client DROP FOREIGN KEY FK_34C1321319EB6921');
        $this->addSql('ALTER TABLE documents_client DROP FOREIGN KEY FK_34C132135F0F2752');
        $this->addSql('DROP TABLE documents_artisan');
        $this->addSql('DROP TABLE documents_client');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documents_artisan (documents_id INT NOT NULL, artisan_id INT NOT NULL, INDEX IDX_A32C6B405ED3C7B7 (artisan_id), INDEX IDX_A32C6B405F0F2752 (documents_id), PRIMARY KEY(documents_id, artisan_id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE documents_client (documents_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_34C1321319EB6921 (client_id), INDEX IDX_34C132135F0F2752 (documents_id), PRIMARY KEY(documents_id, client_id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE documents_artisan ADD CONSTRAINT FK_A32C6B405ED3C7B7 FOREIGN KEY (artisan_id) REFERENCES artisan (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documents_artisan ADD CONSTRAINT FK_A32C6B405F0F2752 FOREIGN KEY (documents_id) REFERENCES documents (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documents_client ADD CONSTRAINT FK_34C1321319EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documents_client ADD CONSTRAINT FK_34C132135F0F2752 FOREIGN KEY (documents_id) REFERENCES documents (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
