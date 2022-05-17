<?php

namespace App\Controller;

use App\Entity\MovieSession;
use App\Repository\MovieSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class MovieSessionController extends AbstractController
{
    #[Route('/movie', name: 'movieSession_list')]
    public function index(Environment $twig, MovieSessionRepository $movieSessionRepository): Response
    {
        return new Response($twig->render('movie_session/index.html.twig', [
            'movieSessions' => $movieSessionRepository->findAll(),
        ]));
    }

    #[Route('/movie/{id}', name: 'movie')]
    public function show(Environment $twig, MovieSession $movieSession): Response
    {
        return new Response($twig->render('movie_session/show.html.twig', [
            'movieSession' => $movieSession,
        ]));
    }
}
