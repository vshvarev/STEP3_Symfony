<?php

namespace App\Tests\Domain\Cinema\Entity;

use App\Domain\Cinema\Entity\Film;
use App\Domain\Cinema\Entity\MovieSession;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

final class MovieSessionTest extends TestCase
{
    private MovieSession $movieSession;

    private Film $film;

    protected function setUp(): void
    {
        $this->film = new Film(Uuid::v4(), 'FilmName', 120);

        $this->movieSession = new MovieSession(
            Uuid::v4(),
            $this->film,
            date_create_immutable('2022-05-22 20:00:00'),
            50,
        );
    }

    public function testGetFormatTimeStart(): void
    {
        self::assertEquals('20:00', $this->movieSession->getFormatTimeStart());
    }

    public function testGetFormatTimeEnd(): void
    {
        self::assertEquals('22:00', $this->movieSession->getFormatTimeEnd());
    }

    public function testGetFilm(): void
    {
        self::assertEquals($this->film, $this->movieSession->getFilm());
    }

    public function testGetFormatDateStart(): void
    {
        self::assertEquals('22 May 2022', $this->movieSession->getFormatDateStart());
    }

    public function testGetCountOfRemainingTickets(): void
    {
        self::assertEquals(50, $this->movieSession->getMaximumCountOfTickets());
    }

    public function testGetTickets(): void
    {
        self::assertCount(0, $this->movieSession->getTickets());
    }

    public function testGetFilmDuration(): void
    {
        self::assertEquals(120, $this->movieSession->getFilmDuration());
    }

    public function testGetMaximumCountOfTickets(): void
    {
        self::assertEquals(50, $this->movieSession->getMaximumCountOfTickets());
    }
}
