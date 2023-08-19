<?php

namespace App\Services\Tournament;

use App\Entity\TeamMatch;
use App\Entity\Tournament;
use App\Repository\TeamRepository;
use App\Repository\TournamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class TournamentService
{
    private const MAX_MATCHES_IN_DAY = 4;

    public function __construct(
        private TournamentRepository $tournamentRepository,
        private TeamRepository $teamRepository,
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator,
    ) {
    }

    /**
     * @return Tournament[]
     */
    public function getAllTournaments(): array
    {
        return $this->tournamentRepository->findAll();
    }

    public function findTournamentBySlug(string $slug): Tournament
    {
        return $this->tournamentRepository->findBySlug($slug);
    }


    public function createTournament(string $name, array $teamIds): Tournament
    {
        if (count($teamIds) < 2) {
            throw new \DomainException("В турнире должно участвовать хотя бы 2 команды");
        }

        $tournament = $this->tournamentRepository->findByName($name);
        if ($tournament !== null) {
            throw new \DomainException("Турнир с таким именем уже существует!");
        }

        $slugger = new AsciiSlugger();
        $slug = $slugger->slug($name);
        $tournament = new Tournament($name, $slug);

        $teams = $this->teamRepository->findAllByIds($teamIds);

        foreach ($teams as $team) {
            $tournament->addTeam($team);
        }

        $errors = $this->validator->validate($tournament);
        if (count($errors) > 0) {
            throw new \DomainException($errors[0]->getMessage());
        }

        $this->entityManager->persist($tournament);
        $this->entityManager->flush();

        return $tournament;
    }

    public function removeTournament(int $id): void
    {
        $tournament = $this->tournamentRepository->findById($id);

        if ($tournament === null) {
            throw new \DomainException("Нет турнира с id=$id");
        }

        $this->entityManager->remove($tournament);
        $this->entityManager->flush();
    }

    public function generateScheduleTournament(Tournament $tournament): void
    {
        $teams = $tournament->getTeams()->toArray();
        $table = $this->getTournamentTable($teams);

        foreach ($table as $day => $matches) {
            foreach ($matches as $match) {
                $teamMatch = new TeamMatch(
                    $tournament,
                    $match[0],
                    $match[1],
                    $day + 1
                );
                $tournament->addMatch($teamMatch);
            }
        }
        $this->entityManager->flush();
    }

    function getTournamentTable(array $teams): array
    {
        $n = count($teams);

        if ($odd = ($n % 2 === 1)) {
            $n++;
        }

        $half = (int)($n / 2);

        $teamsInOrder = [];

        for ($i = 0; $i < ($n - 1); $i++) {
            $teamsInOrder[] = $teams[$i];
        }

        $addDays = 0;
        $daysHaveBeenAdded = false;

        $table = [];

        for ($i = 0; $i < $n - 1; $i++) {
            // если за время прошлой итерации добавилось количество матчей,
            // равное self::MAX_MATCHES_IN_DAY, то добавляем + 1 день
            if (isset($table[$i + $addDays]) && count($table[$i + $addDays]) === self::MAX_MATCHES_IN_DAY) {
                $addDays++;
            }

            if (!$odd) {
                // если четное количество команд, то первая играет с последней
                $table[$i + $addDays][] = [$teamsInOrder[0], $teams[$n-1]];
            }

            // перебираем со второй команды и до середины
            for ($j = 1; $j < $half; $j++) {

                // если количество добавленых матчей в этот день кратно self::MAX_MATCHES_IN_DAY то увеличиваем день
                if (isset($table[$i + $addDays]) && count($table[$i + $addDays]) % self::MAX_MATCHES_IN_DAY === 0) {
                    $addDays++;
                    $daysHaveBeenAdded = true;
                }

                // c разных концов образуем пару
                $table[$i + $addDays][] = [$teamsInOrder[$j], $teamsInOrder[$n - 1 - $j]];
            }


            // если за время итерации добавился день, то уменьшаем его на 1,
            // так как день увеличится при следующей итерации
            if ($daysHaveBeenAdded) {
                $addDays--;
            }
            $daysHaveBeenAdded = false;

            // сдвигаем команды 1 становится на последнее место
            $teamsInOrder[] = array_shift($teamsInOrder);
        }

        return $table;
    }
}