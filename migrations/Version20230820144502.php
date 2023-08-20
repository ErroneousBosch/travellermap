<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820144502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sector (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, x INTEGER NOT NULL, y INTEGER NOT NULL, abbreviation VARCHAR(4) DEFAULT NULL, names CLOB NOT NULL --(DC2Type:json)
        , subsectors CLOB DEFAULT NULL --(DC2Type:json)
        , borders CLOB DEFAULT NULL --(DC2Type:json)
        , routes CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE world (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sector_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, uwp VARCHAR(10) DEFAULT NULL, starport_class VARCHAR(1) DEFAULT NULL, size VARCHAR(1) DEFAULT NULL, atmosphere VARCHAR(1) DEFAULT NULL, hydrographics VARCHAR(1) DEFAULT NULL, population_exponent VARCHAR(1) DEFAULT NULL, government VARCHAR(1) DEFAULT NULL, law_level VARCHAR(1) DEFAULT NULL, tech_level VARCHAR(1) DEFAULT NULL, remarks CLOB DEFAULT NULL --(DC2Type:json)
        , importance INTEGER DEFAULT NULL, economy VARCHAR(5) DEFAULT NULL, resources INTEGER DEFAULT NULL, labor INTEGER DEFAULT NULL, infrastructure INTEGER DEFAULT NULL, efficiency INTEGER DEFAULT NULL, culture VARCHAR(4) DEFAULT NULL, heterogeneity INTEGER DEFAULT NULL, acceptance INTEGER DEFAULT NULL, strangeness INTEGER DEFAULT NULL, symbols INTEGER DEFAULT NULL, nobility VARCHAR(10) DEFAULT NULL, bases VARCHAR(12) DEFAULT NULL, zone VARCHAR(1) DEFAULT NULL, pbg VARCHAR(3) NOT NULL, population_multiplier INTEGER DEFAULT NULL, belts INTEGER DEFAULT NULL, gas_giants INTEGER DEFAULT NULL, bodies INTEGER NOT NULL, allegiance VARCHAR(4) DEFAULT NULL, stellar_data CLOB NOT NULL --(DC2Type:json)
        , ru INTEGER DEFAULT NULL, CONSTRAINT FK_3A771143DE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3A771143DE95C867 ON world (sector_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sector');
        $this->addSql('DROP TABLE world');
    }
}
