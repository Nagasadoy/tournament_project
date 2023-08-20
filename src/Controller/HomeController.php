<?php

namespace App\Controller;

use App\Services\Tournament\TournamentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(TournamentService $tournamentService)
    {
        $tournaments = $tournamentService->getAllTournaments();

        return $this->render('home/home.html.twig', [
            'tournaments' => $tournaments
        ]);
    }
}