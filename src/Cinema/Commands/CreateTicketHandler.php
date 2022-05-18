<?php

namespace App\Cinema\Commands;

use App\Cinema\Entity\Client;
use App\Cinema\Entity\Ticket;
use App\Cinema\Repository\ClientRepository;
use App\Cinema\Repository\TicketRepository;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateTicketHandler implements MessageHandlerInterface
{
    public function __construct(
        private TicketRepository $ticketRepository,
        private ClientRepository $clientRepository,
    ) {}

    public function __invoke(CreateTicketCommand $createTicketCommand): void
    {
        $client = $this->createClient($createTicketCommand);

        $ticket = $this->createTicket($createTicketCommand, $client);

        $this->clientRepository->add($client, true);
        $this->ticketRepository->add($ticket, true);
    }

    #[Pure]
    private function createClient(CreateTicketCommand $createTicketCommand): Client
    {
        return new Client($createTicketCommand->getName(), $createTicketCommand->getPhoneNumber());
    }

    #[Pure]
    private function createTicket(CreateTicketCommand $createTicketCommand, Client $client): Ticket
    {
        return new Ticket($client, $createTicketCommand->getMovieSession());
    }
}
