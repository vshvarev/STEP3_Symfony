<?php

namespace App\Controller;

use App\Commands\CreateTicketCommand;
use App\Entity\Client;
use App\Entity\MovieSession;
use App\Form\ClientFormType;
use App\Repository\MovieSessionRepository;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class MovieSessionController extends AbstractController
{
    private $twig;
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    #[Route('/movie', name: 'movieSession_list')]
    public function index(Environment $twig, MovieSessionRepository $movieSessionRepository, TicketRepository $ticketRepository): Response
    {
        return new Response($twig->render('movie_session/index.html.twig', [
            'movieSessions' => $movieSessionRepository->findAll(),
            'tickets' => $ticketRepository->findAll(),
        ]));
    }

    #[Route('/movie/{id}', name: 'movie')]
    public function show(Environment $twig, MovieSession $movieSession, Request $request, TicketRepository $ticketRepository, MessageBusInterface $bus): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientFormType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch(new CreateTicketCommand($client->getName(), $client->getPhoneNumber(), $movieSession));
        }

        return new Response($twig->render('movie_session/show.html.twig', [
            'movieSession' => $movieSession,
            'tickets' => $ticketRepository->findBy(['movieSession' => $movieSession]),
            'client_form' => $form->createView(),
        ]));
    }
}
