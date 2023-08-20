<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820073722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C4533D1A3E7');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C453AE0B452');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C453E2E58C3');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C4533D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C453AE0B452 FOREIGN KEY (first_team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C453E2E58C3 FOREIGN KEY (second_team_id) REFERENCES team (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C453AE0B452');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C453E2E58C3');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C4533D1A3E7');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C453AE0B452 FOREIGN KEY (first_team_id) REFERENCES team (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C453E2E58C3 FOREIGN KEY (second_team_id) REFERENCES team (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C4533D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
