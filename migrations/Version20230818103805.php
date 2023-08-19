<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230818103805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_tournament (team_id INT NOT NULL, tournament_id INT NOT NULL, INDEX IDX_8386CA1C296CD8AE (team_id), INDEX IDX_8386CA1C33D1A3E7 (tournament_id), PRIMARY KEY(team_id, tournament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1C296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_tournament ADD CONSTRAINT FK_8386CA1C33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4E0A61F5E237E06 ON team (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD5FB8D95E237E06 ON tournament (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD5FB8D9989D9B62 ON tournament (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1C296CD8AE');
        $this->addSql('ALTER TABLE team_tournament DROP FOREIGN KEY FK_8386CA1C33D1A3E7');
        $this->addSql('DROP TABLE team_tournament');
        $this->addSql('DROP INDEX UNIQ_C4E0A61F5E237E06 ON team');
        $this->addSql('DROP INDEX UNIQ_BD5FB8D95E237E06 ON tournament');
        $this->addSql('DROP INDEX UNIQ_BD5FB8D9989D9B62 ON tournament');
    }
}
