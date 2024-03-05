<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305160417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, pic_property_id INT NOT NULL, pic_file VARCHAR(255) NOT NULL, pic_name VARCHAR(255) DEFAULT NULL, pic_href VARCHAR(255) NOT NULL, pic_alt VARCHAR(255) DEFAULT NULL, pic_caption VARCHAR(255) DEFAULT NULL, pic_type VARCHAR(255) NOT NULL, pic_format VARCHAR(255) NOT NULL, pic_width INT NOT NULL, pic_height INT NOT NULL, pic_size NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_16DB4F8931C778CF (pic_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8931C778CF FOREIGN KEY (pic_property_id) REFERENCES property (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8931C778CF');
        $this->addSql('DROP TABLE picture');
    }
}
