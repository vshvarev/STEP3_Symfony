<?php

namespace App\Cinema\Commands;

use App\Cinema\Entity\Client;
use App\Cinema\Entity\Ticket;
use App\Cinema\Repository\ClientRepository;
use App\Cinema\Repository\TicketRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Uid\Uuid;

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

        $this->clientRepository->save($client);
        $this->ticketRepository->save($ticket);
    }

    private function createClient(CreateTicketCommand $createTicketCommand): Client
    {
        return new Client(Uuid::v4(), $createTicketCommand->getName(), $createTicketCommand->getPhoneNumber());
    }

    private function createTicket(CreateTicketCommand $createTicketCommand, Client $client): Ticket
    {
        return new Ticket(Uuid::v4(), $client, $createTicketCommand->getMovieSession());
    }
}
