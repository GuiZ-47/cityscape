<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305115659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE amenity (id INT AUTO_INCREMENT NOT NULL, am_prop_id INT NOT NULL, am_dishwasher TINYINT(1) NOT NULL, am_floor_coverings TINYINT(1) NOT NULL, am_internet TINYINT(1) NOT NULL, am_wardrobes TINYINT(1) NOT NULL, am_supermarket TINYINT(1) NOT NULL, am_kids_zone TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_AB607963BF5AA062 (am_prop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amenity ADD CONSTRAINT FK_AB607963BF5AA062 FOREIGN KEY (am_prop_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property DROP prop_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amenity DROP FOREIGN KEY FK_AB607963BF5AA062');
        $this->addSql('DROP TABLE amenity');
        $this->addSql('ALTER TABLE property ADD prop_id INT DEFAULT NULL');
    }
}
