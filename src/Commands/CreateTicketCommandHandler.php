<?php

namespace App\Commands;

use App\Entity\Client;
use App\Entity\Ticket;
use App\Repository\TicketRepository;

class CreateTicketCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TicketRepository $ticketRepository
    ) {}

    public function __invoke(CreateTicketCommand $createTicketCommand): int
    {
        $client = new Client();

        $client->setName($createTicketCommand->name);
        $client->setPhoneNumber($createTicketCommand->phoneNumber);

        $ticket = new Ticket();

        $ticket->setClient($client);
        $ticket->setMovieSession($createTicketCommand->movieSession);

        $this->ticketRepository->add($ticket);

        return $ticket->getId();
    }
}
