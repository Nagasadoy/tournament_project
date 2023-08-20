<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820131312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C4E0A61F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_tournament (team_id INT NOT NULL, tournament_id INT NOT NULL, INDEX IDX_8386CA1C296CD8AE (team_id), INDEX IDX_8386CA1C33D1A3E7 (tournament_id), PRIMARY KEY(team_id, tournament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_match (id INT AUTO_INCREMENT NOT NULL, first_team_id INT NOT NULL, second_team_id INT NOT NULL, tournament_id INT NOT NULL, day INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BD5D8C453AE0B452 (first_team_id), INDEX IDX_BD5D8C453E2E58C3 (second_team_id), INDEX IDX_BD5D8C4533D1A3E7 (tournament_id), UNIQUE INDEX team_match_unique (first_team_id, second_team_id, tournament_id, day), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_BD5FB8D95E237E06 (name), UNIQUE INDEX UNIQ_BD5FB8D9989D9B62 (slug), UNIQUE INDEX UNIQ_BD5FB8D995275AB8 (start_date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1C296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1C33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C453AE0B452 FOREIGN KEY (first_team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C453E2E58C3 FOREIGN KEY (second_team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C4533D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1C296CD8AE');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1C33D1A3E7');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C453AE0B452');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C453E2E58C3');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C4533D1A3E7');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_tournament');
        $this->addSql('DROP TABLE team_match');
        $this->addSql('DROP TABLE tournament');
    }
}
