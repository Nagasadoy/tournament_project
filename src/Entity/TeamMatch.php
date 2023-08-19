<?php

namespace App\Entity;

use App\Repository\TeamMatchRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamMatchRepository::class)]
class TeamMatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Team $firstTeam;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Team $secondTeam;

    #[ORM\ManyToOne(targetEntity: Tournament::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Tournament $tournament;

    #[ORM\Column]
    private int $day;

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

    public function getDay(): int
    {
        return $this->day;
    }
}
