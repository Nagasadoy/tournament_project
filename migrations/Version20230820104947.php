<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820104947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX team_match_unique ON team_match');
        $this->addSql('ALTER TABLE team_match ADD date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP day');
        $this->addSql('CREATE UNIQUE INDEX team_match_unique ON team_match (first_team_id, second_team_id, tournament_id, date)');
        $this->addSql('ALTER TABLE tournament ADD start_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD5FB8D995275AB8 ON tournament (start_date)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX team_match_unique ON team_match');
        $this->addSql('ALTER TABLE team_match ADD day INT NOT NULL, DROP date');
        $this->addSql('CREATE UNIQUE INDEX team_match_unique ON team_match (first_team_id, second_team_id, tournament_id, day)');
        $this->addSql('DROP INDEX UNIQ_BD5FB8D995275AB8 ON tournament');
        $this->addSql('ALTER TABLE tournament DROP start_date');
    }
}
