<?php

namespace App\Controller;

use App\Services\Team\TeamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamsController extends AbstractController
{
    #[Route('/teams', name: 'teams')]
    public function index(Request $request, TeamService $teamService): Response
    {
        $teamName = $request->request->get('teamName') ?? null;
        $teamIdForDelete = $request->request->get('teamIdForDelete') ?? null;

        try {
            if ($teamName !== null) {
                $teamService->createTeam($teamName);
            }

            if ($teamIdForDelete !== null) {
                $teamService->removeTeam($teamIdForDelete);
            }
        } catch (\DomainException $exception) {
            $this->addFlash('error', $exception->getMessage());
        }

        $teams = $teamService->getAllTeams();
        return $this->render('teams/teams.html.twig', [
            'teams' => $teams
        ]);
    }
}