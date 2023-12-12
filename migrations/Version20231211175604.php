<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211175604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, prestation JSON DEFAULT NULL, date_debut DATE DEFAULT NULL, duree INT DEFAULT NULL, numero VARCHAR(255) DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, localite VARCHAR(255) DEFAULT NULL, budget VARCHAR(255) DEFAULT NULL, date_facture DATE DEFAULT NULL, montant_facture DOUBLE PRECISION DEFAULT NULL, date_accompte DATE DEFAULT NULL, montant_accompte DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, date_fin DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, artisan_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, budget VARCHAR(255) DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, date_facture DATE DEFAULT NULL, montant_facture DOUBLE PRECISION DEFAULT NULL, date_acompte DATE DEFAULT NULL, montant_acompte DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_938720755ED3C7B7 (artisan_id), INDEX IDX_93872075C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720755ED3C7B7 FOREIGN KEY (artisan_id) REFERENCES artisan (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF65964475');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8AC4F294');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8F109917');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DFF98F144A');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF65964475 FOREIGN KEY (image2_carousel_home_id) REFERENCES image (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8AC4F294 FOREIGN KEY (image3_carousel_home_id) REFERENCES image (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8F109917 FOREIGN KEY (image1_carousel_home_id) REFERENCES image (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DFF98F144A FOREIGN KEY (logo_id) REFERENCES image (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720755ED3C7B7');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075C18272');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE tache');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DFF98F144A');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8F109917');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF65964475');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8AC4F294');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DFF98F144A FOREIGN KEY (logo_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8F109917 FOREIGN KEY (image1_carousel_home_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF65964475 FOREIGN KEY (image2_carousel_home_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8AC4F294 FOREIGN KEY (image3_carousel_home_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
