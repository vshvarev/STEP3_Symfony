<?php

namespace App\Tests\Domain\Cinema\Command;

use App\Domain\Cinema\Command\CreateTicketCommand;
use App\Domain\Cinema\Entity\Film;
use App\Domain\Cinema\Entity\MovieSession;
use App\Domain\Cinema\Repository\FilmRepository;
use App\Domain\Cinema\Repository\MovieSessionRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

final class CreateTicketHandlerTest extends WebTestCase
{
    private MovieSession $movieSession;

    public function testHandle(): void
    {
        $this->createMovieSession();
        $messageBus = self::getContainer()->get(MessageBusInterface::class);

        $messageBus->dispatch(new CreateTicketCommand('ClientName', '71234567890', $this->movieSession));

        self::assertEquals(49, $this->movieSession->getCountOfRemainingTickets());
    }

    private function createMovieSession(): void
    {
        $movieSession = new MovieSession(
            Uuid::v4(),
            $this->createFilm(),
            date_create_immutable('2022-05-22 20:00:00'),
            50,
        );
        self::getContainer()->get(MovieSessionRepository::class)->save($movieSession);

        $this->movieSession = $movieSession;
    }

    private function createFilm(): Film
    {
        $film = new Film(Uuid::v4(), 'FilmName', 120);
        self::getContainer()->get(FilmRepository::class)->save($film);

        return $film;
    }
}