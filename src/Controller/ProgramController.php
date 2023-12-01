<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
  
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
      $programs = $programRepository->findAll();
      return $this->render('program/index.html.twig', [
        'programs' => $programs,
     ]);
    }

    #[Route('/{programId}/season/{seasonId}', methods: ['GET'], requirements: ['id'=>'\d+'], name: 'program_season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
      $program = $programRepository->findOneById($programId);

      if (!$program) {
        throw $this->createNotFoundException(
            'No program with id : '.$programId.' found in program\'s table.'
        );
      }

      $season = $seasonRepository->findOneById($seasonId);

      if (!$season) {
        throw $this->createNotFoundException(
            'No season with id : '.$seasonId.' found in season\'s table.'
        );
      }

      return $this->render('program/season_show.html.twig', [
        'program' => $program, 'season' => $season
     ]);
    }

    #[Route('/{id}', methods: ['GET'], requirements: ['id'=>'\d+'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
      $program = $programRepository->findOneById($id);

      if (!$program) {
        throw $this->createNotFoundException(
            'No program with id : '.$id.' found in program\'s table.'
        );
      }

      return $this->render('program/show.html.twig', [
        'program' => $program,
     ]);
    }

    
    
}