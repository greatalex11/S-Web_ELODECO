<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231208081503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artisan (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, raison_sociale VARCHAR(50) DEFAULT NULL, nom_etablissement VARCHAR(50) DEFAULT NULL, siret VARCHAR(50) DEFAULT NULL, nom_gerant VARCHAR(50) DEFAULT NULL, prenom_gerant VARCHAR(50) DEFAULT NULL, date_naissance DATE DEFAULT NULL, numero_rue VARCHAR(50) DEFAULT NULL, code_postal VARCHAR(50) DEFAULT NULL, localite VARCHAR(50) DEFAULT NULL, tel_fixe VARCHAR(50) DEFAULT NULL, tel_portable VARCHAR(50) DEFAULT NULL, fax VARCHAR(50) DEFAULT NULL, note_globale INT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_3C600AD3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, numero_rue VARCHAR(255) DEFAULT NULL, rue VARCHAR(50) DEFAULT NULL, code_postal VARCHAR(50) DEFAULT NULL, localite VARCHAR(50) DEFAULT NULL, tel_fix VARCHAR(50) DEFAULT NULL, tel_portable VARCHAR(50) DEFAULT NULL, date_naissance DATE DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_form (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, sujet VARCHAR(255) DEFAULT NULL, message LONGTEXT DEFAULT NULL, date_creation DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenus (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, titre1 VARCHAR(255) NOT NULL, titre2 VARCHAR(255) DEFAULT NULL, titre3 VARCHAR(255) DEFAULT NULL, texte1 LONGTEXT DEFAULT NULL, texte2 LONGTEXT DEFAULT NULL, texte3 LONGTEXT DEFAULT NULL, publier TINYINT(1) DEFAULT NULL, liste JSON DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenus_page (contenus_id INT NOT NULL, page_id INT NOT NULL, INDEX IDX_74F55C1042EAAF3 (contenus_id), INDEX IDX_74F55C10C4663E4 (page_id), PRIMARY KEY(contenus_id, page_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, format VARCHAR(255) DEFAULT NULL, hauteur INT DEFAULT NULL, largeur INT DEFAULT NULL, dimensions VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_contenus (image_id INT NOT NULL, contenus_id INT NOT NULL, INDEX IDX_2211AE9E3DA5256D (image_id), INDEX IDX_2211AE9E42EAAF3 (contenus_id), PRIMARY KEY(image_id, contenus_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, commentaires LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE peripheriques (id INT AUTO_INCREMENT NOT NULL, logo_id INT DEFAULT NULL, image1_carousel_home_id INT DEFAULT NULL, image2_carousel_home_id INT DEFAULT NULL, image3_carousel_home_id INT DEFAULT NULL, nom_entreprise VARCHAR(255) DEFAULT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, numero_rue VARCHAR(255) DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, localite VARCHAR(255) DEFAULT NULL, capital_social VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, linked_in VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, twiter VARCHAR(255) DEFAULT NULL, horaire_matin VARCHAR(255) DEFAULT NULL, horaire_pm VARCHAR(255) DEFAULT NULL, jours_fermes VARCHAR(255) DEFAULT NULL, a_propos_menu_lat LONGTEXT DEFAULT NULL, titre1_menu_lat VARCHAR(255) DEFAULT NULL, titre2_menu_lat VARCHAR(255) DEFAULT NULL, texte_menu_lat LONGTEXT DEFAULT NULL, titre1_home VARCHAR(255) DEFAULT NULL, titre2_home VARCHAR(255) DEFAULT NULL, titre3_home VARCHAR(255) DEFAULT NULL, themes_pied_page JSON DEFAULT NULL, titre_pied_page VARCHAR(255) DEFAULT NULL, couleur_initale_bg VARCHAR(255) DEFAULT NULL, couleur_actuelle_bg VARCHAR(255) DEFAULT NULL, date_modification DATE DEFAULT NULL, titre3_menu_lat VARCHAR(255) DEFAULT NULL, titre_footer VARCHAR(255) DEFAULT NULL, INDEX IDX_261995DFF98F144A (logo_id), INDEX IDX_261995DF8F109917 (image1_carousel_home_id), INDEX IDX_261995DF65964475 (image2_carousel_home_id), INDEX IDX_261995DF8AC4F294 (image3_carousel_home_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artisan ADD CONSTRAINT FK_3C600AD3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contenus_page ADD CONSTRAINT FK_74F55C1042EAAF3 FOREIGN KEY (contenus_id) REFERENCES contenus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contenus_page ADD CONSTRAINT FK_74F55C10C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_contenus ADD CONSTRAINT FK_2211AE9E3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_contenus ADD CONSTRAINT FK_2211AE9E42EAAF3 FOREIGN KEY (contenus_id) REFERENCES contenus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DFF98F144A FOREIGN KEY (logo_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8F109917 FOREIGN KEY (image1_carousel_home_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF65964475 FOREIGN KEY (image2_carousel_home_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8AC4F294 FOREIGN KEY (image3_carousel_home_id) REFERENCES image (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artisan DROP FOREIGN KEY FK_3C600AD3A76ED395');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE contenus_page DROP FOREIGN KEY FK_74F55C1042EAAF3');
        $this->addSql('ALTER TABLE contenus_page DROP FOREIGN KEY FK_74F55C10C4663E4');
        $this->addSql('ALTER TABLE image_contenus DROP FOREIGN KEY FK_2211AE9E3DA5256D');
        $this->addSql('ALTER TABLE image_contenus DROP FOREIGN KEY FK_2211AE9E42EAAF3');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DFF98F144A');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8F109917');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF65964475');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8AC4F294');
        $this->addSql('DROP TABLE artisan');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contact_form');
        $this->addSql('DROP TABLE contenus');
        $this->addSql('DROP TABLE contenus_page');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_contenus');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE peripheriques');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
