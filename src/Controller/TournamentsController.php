<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\TeamMatch;
use App\Services\Team\TeamService;
use App\Services\Tournament\TournamentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TournamentsController extends AbstractController
{

    #[Route('/tournaments/{slug}', name: 'tournament_schedule')]
    public function concreteTournament(
        string $slug,
        TournamentService $tournamentService
    ): Response
    {
        $tournament = $tournamentService->findTournamentBySlug($slug);

        $matchesByDay = [];
        foreach ($tournament->getMatches() as $match) {
            $matchesByDay[$match->getDay()][] = $match;
        }

        return $this->render('tournaments/tournament.html.twig', [
            'tournament' => $tournament,
            'matchesByDay' => $matchesByDay
        ]);
    }

    #[Route('/tournaments', name: 'tournaments')]
    public function index(
        Request $request,
        TeamService $teamService,
        TournamentService $tournamentService
    ): Response
    {
        $teamIds = ($request->request->all())['teamIds'] ?? [];
        $tournamentName = $request->request->get('tournamentName') ?? null;
        $tournamentIdForDelete = $request->request->get('tournamentIdForDelete') ?? null;

        $teams = $teamService->getAllTeams();

        try {
            if ($teamIds !== null && $tournamentName !== null) {

                if (count($teamIds) === 0) {
                    $teamIds = array_map(function (/** @var Team $team */ $team) {
                        return $team->getId();
                    }, $teams);
                }

                $tournament = $tournamentService->createTournament($tournamentName, $teamIds);
                $tournamentService->generateScheduleTournament($tournament);
            }

            if ($tournamentIdForDelete !== null) {
                $tournamentService->removeTournament($tournamentIdForDelete);
            }
        } catch (\DomainException $exception) {
            $this->addFlash('error', $exception->getMessage());
        }

        $tournaments = $tournamentService->getAllTournaments();

        return $this->render('tournaments/tournaments.html.twig', [
            'tournaments' => $tournaments,
            'teams' => $teams
        ]);
    }

}