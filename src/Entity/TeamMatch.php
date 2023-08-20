<?php

namespace App\Entity;

use App\Repository\TeamMatchRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamMatchRepository::class)]
#[ORM\UniqueConstraint(
    name: 'team_match_unique',
    columns: ['first_team_id', 'second_team_id', 'tournament_id', 'day']
)]
class TeamMatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Team::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Team $firstTeam;

    #[ORM\ManyToOne(targetEntity: Team::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Team $secondTeam;

    #[ORM\ManyToOne(inversedBy: 'matches')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Tournament $tournament = null;

    #[ORM\Column]
    private int $day;

    #[ORM\Column]
    private \DateTimeImmutable $date;

    public function __construct(
        Tournament $tournament,
        Team $firstTeam,
        Team $secondTeam,
        int $day
    ) {
        $this->tournament = $tournament;
        $this->firstTeam = $firstTeam;
        $this->secondTeam = $secondTeam;
        $this->day = $day;
        $this->date = ($tournament->getStartDate())->modify('+' . ($day - 1) . ' days');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstTeam(): Team
    {
        return $this->firstTeam;
    }

    public function getSecondTeam(): Team
    {
        return $this->secondTeam;
    }

    public function getTournament(): Tournament
    {
        return $this->tournament;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getDay(): int
    {
        return $this->day;
    }

    public function setTournament(?Tournament $tournament): static
    {
        $this->tournament = $tournament;

        return $this;
    }
}
