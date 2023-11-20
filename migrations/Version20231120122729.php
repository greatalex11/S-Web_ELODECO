<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120122729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisan ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artisan ADD CONSTRAINT FK_3C600AD39D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3C600AD39D86650F ON artisan (user_id_id)');
        $this->addSql('ALTER TABLE client ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404559D86650F ON client (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisan DROP FOREIGN KEY FK_3C600AD39D86650F');
        $this->addSql('DROP INDEX UNIQ_3C600AD39D86650F ON artisan');
        $this->addSql('ALTER TABLE artisan DROP user_id_id');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404559D86650F');
        $this->addSql('DROP INDEX UNIQ_C74404559D86650F ON client');
        $this->addSql('ALTER TABLE client DROP user_id_id');
    }
}
