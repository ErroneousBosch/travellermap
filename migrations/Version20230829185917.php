<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230829185917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allegiance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(4) NOT NULL, legacy_code VARCHAR(2) DEFAULT NULL)');
        $this->addSql('CREATE TABLE allegiance_sector (allegiance_id INTEGER NOT NULL, sector_id INTEGER NOT NULL, PRIMARY KEY(allegiance_id, sector_id), CONSTRAINT FK_E66C3BF33FBAC713 FOREIGN KEY (allegiance_id) REFERENCES allegiance (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E66C3BF3DE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E66C3BF33FBAC713 ON allegiance_sector (allegiance_id)');
        $this->addSql('CREATE INDEX IDX_E66C3BF3DE95C867 ON allegiance_sector (sector_id)');
        $this->addSql('CREATE TABLE metadata (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, bundle VARCHAR(32) NOT NULL, code VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, extra_data CLOB DEFAULT NULL --(DC2Type:json)
        , name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE remark (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sophonts_id INTEGER DEFAULT NULL, allegiance_id INTEGER DEFAULT NULL, control_id INTEGER DEFAULT NULL, code VARCHAR(16) DEFAULT NULL, uniqid VARCHAR(16) NOT NULL, description VARCHAR(255) NOT NULL, extra_info VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_E1CAD8397CDEA541 FOREIGN KEY (sophonts_id) REFERENCES sophont (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E1CAD8393FBAC713 FOREIGN KEY (allegiance_id) REFERENCES allegiance (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E1CAD83932BEC70E FOREIGN KEY (control_id) REFERENCES world (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E1CAD8397CDEA541 ON remark (sophonts_id)');
        $this->addSql('CREATE INDEX IDX_E1CAD8393FBAC713 ON remark (allegiance_id)');
        $this->addSql('CREATE INDEX IDX_E1CAD83932BEC70E ON remark (control_id)');
        $this->addSql('CREATE TABLE sector (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, x INTEGER NOT NULL, y INTEGER NOT NULL, abbreviation VARCHAR(4) DEFAULT NULL, names CLOB NOT NULL --(DC2Type:json)
        , borders CLOB DEFAULT NULL --(DC2Type:json)
        , routes CLOB DEFAULT NULL --(DC2Type:json)
        , uniqid VARCHAR(255) NOT NULL, milieu VARCHAR(32) NOT NULL, regions CLOB DEFAULT NULL --(DC2Type:json)
        , subsectors CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE sector_metadata (sector_id INTEGER NOT NULL, metadata_id INTEGER NOT NULL, PRIMARY KEY(sector_id, metadata_id), CONSTRAINT FK_EAB40CECDE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_EAB40CECDC9EE959 FOREIGN KEY (metadata_id) REFERENCES metadata (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EAB40CECDE95C867 ON sector_metadata (sector_id)');
        $this->addSql('CREATE INDEX IDX_EAB40CECDC9EE959 ON sector_metadata (metadata_id)');
        $this->addSql('CREATE TABLE sophont (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(4) NOT NULL)');
        $this->addSql('CREATE TABLE sophont_sector (sophont_id INTEGER NOT NULL, sector_id INTEGER NOT NULL, PRIMARY KEY(sophont_id, sector_id), CONSTRAINT FK_13C06D0FCBDAD4C0 FOREIGN KEY (sophont_id) REFERENCES sophont (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_13C06D0FDE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_13C06D0FCBDAD4C0 ON sophont_sector (sophont_id)');
        $this->addSql('CREATE INDEX IDX_13C06D0FDE95C867 ON sophont_sector (sector_id)');
        $this->addSql('CREATE TABLE world (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sector_id INTEGER NOT NULL, allegiance_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, uwp VARCHAR(10) DEFAULT NULL, starport_class VARCHAR(1) DEFAULT NULL, size VARCHAR(1) DEFAULT NULL, atmosphere VARCHAR(1) DEFAULT NULL, hydrographics VARCHAR(1) DEFAULT NULL, population_exponent VARCHAR(1) DEFAULT NULL, government VARCHAR(1) DEFAULT NULL, law_level VARCHAR(1) DEFAULT NULL, tech_level VARCHAR(1) DEFAULT NULL, importance INTEGER DEFAULT NULL, economy VARCHAR(5) DEFAULT NULL, resources INTEGER DEFAULT NULL, labor INTEGER DEFAULT NULL, infrastructure INTEGER DEFAULT NULL, efficiency INTEGER DEFAULT NULL, culture VARCHAR(4) DEFAULT NULL, heterogeneity INTEGER DEFAULT NULL, acceptance INTEGER DEFAULT NULL, strangeness INTEGER DEFAULT NULL, symbols INTEGER DEFAULT NULL, nobility VARCHAR(10) DEFAULT NULL, bases VARCHAR(12) DEFAULT NULL, zone VARCHAR(1) DEFAULT NULL, pbg VARCHAR(3) NOT NULL, population_multiplier INTEGER DEFAULT NULL, belts INTEGER DEFAULT NULL, gas_giants INTEGER DEFAULT NULL, bodies INTEGER NOT NULL, stellar_data CLOB NOT NULL --(DC2Type:json)
        , ru INTEGER DEFAULT NULL, uniqid VARCHAR(255) NOT NULL, milieu VARCHAR(32) DEFAULT NULL, subsector VARCHAR(1) DEFAULT NULL, CONSTRAINT FK_3A771143DE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_3A7711433FBAC713 FOREIGN KEY (allegiance_id) REFERENCES allegiance (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3A771143DE95C867 ON world (sector_id)');
        $this->addSql('CREATE INDEX IDX_3A7711433FBAC713 ON world (allegiance_id)');
        $this->addSql('CREATE TABLE world_remark (world_id INTEGER NOT NULL, remark_id INTEGER NOT NULL, PRIMARY KEY(world_id, remark_id), CONSTRAINT FK_71F4A57A8925311C FOREIGN KEY (world_id) REFERENCES world (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_71F4A57A7FAB7F77 FOREIGN KEY (remark_id) REFERENCES remark (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_71F4A57A8925311C ON world_remark (world_id)');
        $this->addSql('CREATE INDEX IDX_71F4A57A7FAB7F77 ON world_remark (remark_id)');
        $this->addSql('CREATE TABLE worlds (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, allegiance_id INTEGER DEFAULT NULL, CONSTRAINT FK_F4E1A8303FBAC713 FOREIGN KEY (allegiance_id) REFERENCES allegiance (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F4E1A8303FBAC713 ON worlds (allegiance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE allegiance');
        $this->addSql('DROP TABLE allegiance_sector');
        $this->addSql('DROP TABLE metadata');
        $this->addSql('DROP TABLE remark');
        $this->addSql('DROP TABLE sector');
        $this->addSql('DROP TABLE sector_metadata');
        $this->addSql('DROP TABLE sophont');
        $this->addSql('DROP TABLE sophont_sector');
        $this->addSql('DROP TABLE world');
        $this->addSql('DROP TABLE world_remark');
        $this->addSql('DROP TABLE worlds');
    }
}
