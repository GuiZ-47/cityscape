<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313121420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81D4948FC3');
        $this->addSql('ALTER TABLE feature DROP FOREIGN KEY FK_1FD77566EDB74B6E');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE feature');
        $this->addSql('DROP INDEX IDX_D4E6F81D4948FC3 ON address');
        $this->addSql('ALTER TABLE address ADD country VARCHAR(255) NOT NULL, DROP add_country_id');
        $this->addSql('ALTER TABLE property ADD prop_feature LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, ct_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE feature (id INT AUTO_INCREMENT NOT NULL, feat_property_id INT NOT NULL, feat_title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_1FD77566EDB74B6E (feat_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE feature ADD CONSTRAINT FK_1FD77566EDB74B6E FOREIGN KEY (feat_property_id) REFERENCES property (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE address ADD add_country_id INT NOT NULL, DROP country');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81D4948FC3 FOREIGN KEY (add_country_id) REFERENCES country (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D4E6F81D4948FC3 ON address (add_country_id)');
        $this->addSql('ALTER TABLE property DROP prop_feature');
    }
}
