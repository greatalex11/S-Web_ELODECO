<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207085909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peripheriques ADD logo_id INT DEFAULT NULL, ADD image1_carousel_home_id INT DEFAULT NULL, ADD image2_carousel_home_id INT DEFAULT NULL, ADD image3_carousel_home_id INT DEFAULT NULL, DROP image_logo');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DFF98F144A FOREIGN KEY (logo_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8F109917 FOREIGN KEY (image1_carousel_home_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF65964475 FOREIGN KEY (image2_carousel_home_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE peripheriques ADD CONSTRAINT FK_261995DF8AC4F294 FOREIGN KEY (image3_carousel_home_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_261995DFF98F144A ON peripheriques (logo_id)');
        $this->addSql('CREATE INDEX IDX_261995DF8F109917 ON peripheriques (image1_carousel_home_id)');
        $this->addSql('CREATE INDEX IDX_261995DF65964475 ON peripheriques (image2_carousel_home_id)');
        $this->addSql('CREATE INDEX IDX_261995DF8AC4F294 ON peripheriques (image3_carousel_home_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DFF98F144A');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8F109917');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF65964475');
        $this->addSql('ALTER TABLE peripheriques DROP FOREIGN KEY FK_261995DF8AC4F294');
        $this->addSql('DROP INDEX IDX_261995DFF98F144A ON peripheriques');
        $this->addSql('DROP INDEX IDX_261995DF8F109917 ON peripheriques');
        $this->addSql('DROP INDEX IDX_261995DF65964475 ON peripheriques');
        $this->addSql('DROP INDEX IDX_261995DF8AC4F294 ON peripheriques');
        $this->addSql('ALTER TABLE peripheriques ADD image_logo VARCHAR(255) DEFAULT NULL, DROP logo_id, DROP image1_carousel_home_id, DROP image2_carousel_home_id, DROP image3_carousel_home_id');
    }
}
