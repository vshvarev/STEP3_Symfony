<?php

namespace App\Domain\Cinema\Command;

use App\Domain\Cinema\Entity\Client;
use App\Domain\Cinema\Entity\Ticket;
use App\Domain\Cinema\Repository\MovieSessionRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Uid\Uuid;

final class CreateTicketHandler implements MessageHandlerInterface
{
    public function __construct(
        private MovieSessionRepository $movieSessionRepository,
    ) {}

    public function __invoke(CreateTicketCommand $createTicketCommand): void
    {
        $movieSession = $createTicketCommand->getMovieSession();

        $client = $this->createClient($createTicketCommand);

        $ticket = $this->createTicket($createTicketCommand, $client);

        $movieSession->addTicket($ticket);

        $this->movieSessionRepository->save($movieSession);
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
