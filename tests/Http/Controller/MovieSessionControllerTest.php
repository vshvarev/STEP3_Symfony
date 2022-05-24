<?php

namespace App\Tests\Http\Controller;

use App\Domain\Cinema\Entity\Film;
use App\Domain\Cinema\Entity\MovieSession;
use App\Domain\Cinema\Repository\FilmRepository;
use App\Domain\Cinema\Repository\MovieSessionRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Uid\Uuid;

final class MovieSessionControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        self::ensureKernelShutdown();
        self::createClient()->request('GET', '/movie');

        self::assertResponseIsSuccessful();
    }

    public function testShow(): void
    {
        $movieSession = $this->createMovieSession();

        self::ensureKernelShutdown();
        self::createClient()->request('GET', sprintf('/movie/%s', $movieSession->getId()));

        self::assertResponseIsSuccessful();
    }

    private function createMovieSession(): MovieSession
    {
        $movieSession = new MovieSession(
            Uuid::v4(),
            $this->createFilm(),
            date_create_immutable('2022-05-22 20:00:00'),
            50,
        );
        $this->getContainer()->get(MovieSessionRepository::class)->save($movieSession);

        return $movieSession;
    }

    private function createFilm(): Film
    {
        $film = new Film(Uuid::v4(), 'FilmName', 120);
        $this->getContainer()->get(FilmRepository::class)->save($film);

        return $film;
    }
}
