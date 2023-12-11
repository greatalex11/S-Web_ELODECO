<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207133354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE peripheriques (id INT AUTO_INCREMENT NOT NULL, logo_id INT DEFAULT NULL, image1_carousel_home_id INT DEFAULT NULL, image2_carousel_home_id INT DEFAULT NULL, image3_carousel_home_id INT DEFAULT NULL, nom_entreprise VARCHAR(255) DEFAULT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, numero_rue VARCHAR(255) DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, localite VARCHAR(255) DEFAULT NULL, capital_social VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, linked_in VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, twiter VARCHAR(255) DEFAULT NULL, horaire_matin VARCHAR(255) DEFAULT NULL, horaire_pm VARCHAR(255) DEFAULT NULL, jours_fermes VARCHAR(255) DEFAULT NULL, a_propos_menu_lat LONGTEXT DEFAULT NULL, titre1_menu_lat VARCHAR(255) DEFAULT NULL, titre2_menu_lat VARCHAR(255) DEFAULT NULL, texte_menu_lat LONGTEXT DEFAULT NULL, titre1_home VARCHAR(255) DEFAULT NULL, titre2_home VARCHAR(255) DEFAULT NULL, titre3_home VARCHAR(255) DEFAULT NULL, themes_pied_page LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', titre_pied_page VARCHAR(255) DEFAULT NULL, couleur_initale_bg VARCHAR(255) DEFAULT NULL, couleur_actuelle_bg VARCHAR(255) DEFAULT NULL, date_modification DATE DEFAULT NULL, titre3_menu_lat VARCHAR(255) DEFAULT NULL, INDEX IDX_261995DFF98F144A (logo_id), INDEX IDX_261995DF8F109917 (image1_carousel_home_id), INDEX IDX_261995DF65964475 (image2_carousel_home_id), INDEX IDX_261995DF8AC4F294 (image3_carousel_home_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DFF98F144A FOREIGN KEY (logo_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8F109917 FOREIGN KEY (image1_carousel_home_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF65964475 FOREIGN KEY (image2_carousel_home_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8AC4F294 FOREIGN KEY (image3_carousel_home_id) REFERENCES image (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DFF98F144A');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8F109917');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF65964475');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8AC4F294');
        $this->addSql('DROP TABLE peripheriques');
    }
}
