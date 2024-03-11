<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240309191233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_blog (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, blog_description LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_response (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, response LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amenity DROP FOREIGN KEY FK_AB607963BF5AA062');
        $this->addSql('DROP INDEX UNIQ_AB607963BF5AA062 ON amenity');
        $this->addSql('ALTER TABLE amenity ADD property_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', ADD deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', DROP am_prop_id, DROP am_dishwasher, DROP am_floor_coverings, DROP am_internet, DROP am_wardrobes, DROP am_supermarket, DROP am_kids_zone');
        $this->addSql('ALTER TABLE amenity ADD CONSTRAINT FK_AB607963549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('CREATE INDEX IDX_AB607963549213EC ON amenity (property_id)');
        $this->addSql('ALTER TABLE category ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', ADD deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE picture ADD deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE property ADD agent_immobilier_id INT NOT NULL, ADD prop_title VARCHAR(255) NOT NULL, ADD prop_description LONGTEXT NOT NULL, ADD prop_longitude VARCHAR(255) DEFAULT NULL, ADD prop_latitude VARCHAR(255) DEFAULT NULL, ADD deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE50BBCE1E FOREIGN KEY (agent_immobilier_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8BF21CDE50BBCE1E ON property (agent_immobilier_id)');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', ADD deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article_blog');
        $this->addSql('DROP TABLE blog_category');
        $this->addSql('DROP TABLE question_response');
        $this->addSql('ALTER TABLE user DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE picture DROP deleted_at, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE category DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE amenity DROP FOREIGN KEY FK_AB607963549213EC');
        $this->addSql('DROP INDEX IDX_AB607963549213EC ON amenity');
        $this->addSql('ALTER TABLE amenity ADD am_prop_id INT NOT NULL, ADD am_dishwasher TINYINT(1) NOT NULL, ADD am_floor_coverings TINYINT(1) NOT NULL, ADD am_internet TINYINT(1) NOT NULL, ADD am_wardrobes TINYINT(1) NOT NULL, ADD am_supermarket TINYINT(1) NOT NULL, ADD am_kids_zone TINYINT(1) NOT NULL, DROP property_id, DROP name, DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE amenity ADD CONSTRAINT FK_AB607963BF5AA062 FOREIGN KEY (am_prop_id) REFERENCES property (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB607963BF5AA062 ON amenity (am_prop_id)');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE50BBCE1E');
        $this->addSql('DROP INDEX IDX_8BF21CDE50BBCE1E ON property');
        $this->addSql('ALTER TABLE property DROP agent_immobilier_id, DROP prop_title, DROP prop_description, DROP prop_longitude, DROP prop_latitude, DROP deleted_at, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
