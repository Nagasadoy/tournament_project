<?php

namespace App\Services\Team;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class TeamService
{
    public function __construct(
        private TeamRepository $teamRepository,
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator,
    ) {
    }

    public function createTeam(string $name): void
    {
        $team = $this->teamRepository->findByName($name);

        if ($team !== null) {
            throw new \DomainException("Команда с таким именем уже существует");
        }

        $team = new Team($name);
        $errors = $this->validator->validate($team);
        if (count($errors) > 0) {
            throw new \DomainException($errors[0]->getMessage());
        }

        $this->entityManager->persist($team);
        $this->entityManager->flush();
    }

    public function removeTeam(int $id): void
    {
        $team = $this->teamRepository->findById($id);

        if ($team === null) {
            throw new \DomainException("Нет команды с id=$id");
        }

        $this->entityManager->remove($team);
        $this->entityManager->flush();
    }

    public function getAllTeams(): array
    {
        return $this->teamRepository->findAll();
    }
}