<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220064527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, projet_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, date_peremption DATE NOT NULL, mise_en_copie LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_A2B07288C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documents_client (documents_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_34C132135F0F2752 (documents_id), INDEX IDX_34C1321319EB6921 (client_id), PRIMARY KEY(documents_id, client_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documents_artisan (documents_id INT NOT NULL, artisan_id INT NOT NULL, INDEX IDX_A32C6B405F0F2752 (documents_id), INDEX IDX_A32C6B405ED3C7B7 (artisan_id), PRIMARY KEY(documents_id, artisan_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE documents_client ADD CONSTRAINT FK_34C132135F0F2752 FOREIGN KEY (documents_id) REFERENCES documents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documents_client ADD CONSTRAINT FK_34C1321319EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documents_artisan ADD CONSTRAINT FK_A32C6B405F0F2752 FOREIGN KEY (documents_id) REFERENCES documents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documents_artisan ADD CONSTRAINT FK_A32C6B405ED3C7B7 FOREIGN KEY (artisan_id) REFERENCES artisan (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288C18272');
        $this->addSql('ALTER TABLE documents_client DROP FOREIGN KEY FK_34C132135F0F2752');
        $this->addSql('ALTER TABLE documents_client DROP FOREIGN KEY FK_34C1321319EB6921');
        $this->addSql('ALTER TABLE documents_artisan DROP FOREIGN KEY FK_A32C6B405F0F2752');
        $this->addSql('ALTER TABLE documents_artisan DROP FOREIGN KEY FK_A32C6B405ED3C7B7');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE documents_client');
        $this->addSql('DROP TABLE documents_artisan');
    }
}
