<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\Length(min: 1, max: 50, minMessage: 'Имя слишком короткое', maxMessage: 'Имя слишком длинное')]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Tournament::class, inversedBy: 'teams')]
    private Collection $tournaments;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->tournaments = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Tournament>
     */
    public function getTournaments(): Collection
    {
        return $this->tournaments;
    }

    public function addTournament(Tournament $tournament): static
    {
        if (!$this->tournaments->contains($tournament)) {
            $this->tournaments->add($tournament);
        }

        return $this;
    }

    public function removeTournament(Tournament $tournament): static
    {
        $this->tournaments->removeElement($tournament);

        return $this;
    }

}
