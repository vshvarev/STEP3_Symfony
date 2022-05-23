<?php

namespace App\Http\Controller;

use App\Domain\Cinema\Command\CreateTicketCommand;
use App\Domain\Cinema\DTO\ClientDTO;
use App\Http\Form\ClientFormType;
use App\Domain\Cinema\Repository\MovieSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
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
    public function show(Request $request, string $id, MessageBusInterface $bus, MovieSessionRepository $movieSessionRepository): Response
    {
        try {
            $uuid = Uuid::fromString($id);
            $movieSession = $movieSessionRepository->find($id);
        } catch (\Exception) {
            return $this->redirectToRoute('movieSession_list');
        }

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
