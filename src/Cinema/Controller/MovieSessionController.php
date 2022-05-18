<?php

namespace App\Cinema\Controller;

use App\Cinema\Commands\CreateTicketCommand;
use App\Cinema\DTO\ClientDTO;
use App\Cinema\Entity\MovieSession;
use App\Cinema\Form\ClientFormType;
use App\Cinema\Repository\MovieSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

final class MovieSessionController extends AbstractController
{
    public function __construct(
        private Environment $twig,
    ) {}

    #[Route('/movie', name: 'movieSession_list')]
    public function index(MovieSessionRepository $movieSessionRepository): Response
    {
        return new Response($this->twig->render('movie_session/index.html.twig', [
            'movieSessions' => $movieSessionRepository->findAll(),
        ]));
    }

    #[Route('/movie/{id}', name: 'movie')]
    public function show(MovieSession $movieSession, Request $request, MessageBusInterface $bus): Response
    {
        $client = new ClientDTO();

        $form = $this->createForm(ClientFormType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch(new CreateTicketCommand($client->getName(), $client->getPhoneNumber(), $movieSession));

            return $this->redirectToRoute('movieSession_list');
        }

        return new Response($this->twig->render('movie_session/show.html.twig', [
            'movieSession' => $movieSession,
            'client_form' => $form->createView(),
        ]));
    }
}
