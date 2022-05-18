<?php

namespace App\Commands;

use App\Entity\Client;
use App\Entity\Ticket;
use App\Repository\ClientRepository;
use App\Repository\TicketRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateTicketHandler implements MessageHandlerInterface
{
    public function __construct(
        private TicketRepository $ticketRepository,
        private ClientRepository $clientRepository,
    ) {}

    public function __invoke(CreateTicketCommand $createTicketCommand): void
    {
        $client = new Client();

        $client->setName($createTicketCommand->getName());
        $client->setPhoneNumber($createTicketCommand->getPhoneNumber());

        $ticket = new Ticket();

        $ticket->setClient($client);
        $ticket->setMovieSession($createTicketCommand->getMovieSession());

        $this->clientRepository->add($client, true);
        $this->ticketRepository->add($ticket, true);
    }
}
