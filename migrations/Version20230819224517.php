<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230819224517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_match (id INT AUTO_INCREMENT NOT NULL, first_team_id INT NOT NULL, second_team_id INT NOT NULL, tournament_id INT NOT NULL, day INT NOT NULL, INDEX IDX_BD5D8C453AE0B452 (first_team_id), INDEX IDX_BD5D8C453E2E58C3 (second_team_id), INDEX IDX_BD5D8C4533D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C453AE0B452 FOREIGN KEY (first_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C453E2E58C3 FOREIGN KEY (second_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C4533D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('DROP TABLE meet');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meet (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C453AE0B452');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C453E2E58C3');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C4533D1A3E7');
        $this->addSql('DROP TABLE team_match');
    }
}
