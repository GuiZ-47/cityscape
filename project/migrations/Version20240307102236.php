<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307102236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8931C778CF');
        $this->addSql('DROP INDEX IDX_16DB4F8931C778CF ON picture');
        $this->addSql('ALTER TABLE picture ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_size INT DEFAULT NULL, ADD created_at DATETIME DEFAULT \'current_timestamp\' COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT \'current_timestamp\' COMMENT \'(DC2Type:datetime_immutable)\', DROP pic_property_id, DROP pic_file, DROP pic_name, DROP pic_href, DROP pic_alt, DROP pic_caption, DROP pic_type, DROP pic_format, DROP pic_width, DROP pic_height, DROP pic_size');
        $this->addSql('ALTER TABLE property ADD updated_at DATETIME DEFAULT \'current_timestamp\' COMMENT \'(DC2Type:datetime_immutable)\', CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp\' COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD pic_property_id INT NOT NULL, ADD pic_file VARCHAR(255) NOT NULL, ADD pic_href VARCHAR(255) NOT NULL, ADD pic_alt VARCHAR(255) DEFAULT NULL, ADD pic_caption VARCHAR(255) DEFAULT NULL, ADD pic_type VARCHAR(255) NOT NULL, ADD pic_format VARCHAR(255) NOT NULL, ADD pic_width INT NOT NULL, ADD pic_height INT NOT NULL, ADD pic_size NUMERIC(10, 2) DEFAULT NULL, DROP image_size, DROP created_at, DROP updated_at, CHANGE image_name pic_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8931C778CF FOREIGN KEY (pic_property_id) REFERENCES property (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_16DB4F8931C778CF ON picture (pic_property_id)');
        $this->addSql('ALTER TABLE property DROP updated_at, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
