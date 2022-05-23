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

    public function setUp(): void
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
        $this->assertEquals('20:00', $this->movieSession->getFormatTimeStart());
    }

    public function testGetFormatTimeEnd(): void
    {
        $this->assertEquals('22:00', $this->movieSession->getFormatTimeEnd());
    }

    public function testGetFilm(): void
    {
        $this->assertEquals($this->film, $this->movieSession->getFilm());
    }

    public function testGetFormatDateStart(): void
    {
        $this->assertEquals('22 May 2022', $this->movieSession->getFormatDateStart());
    }

    public function testGetCountOfRemainingTickets(): void
    {
        $this->assertEquals(50, $this->movieSession->getMaximumCountOfTickets());
    }

    public function testGetTickets(): void
    {
        $this->assertCount(0, $this->movieSession->getTickets());
    }

    public function testGetFilmDuration(): void
    {
        $this->assertEquals(120, $this->movieSession->getFilmDuration());
    }

    public function testGetMaximumCountOfTickets(): void
    {
        $this->assertEquals(50, $this->movieSession->getMaximumCountOfTickets());
    }
}
