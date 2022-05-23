<?php

namespace App\Tests\Domain\Cinema\Entity;

use App\Domain\Cinema\Entity\Film;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

final class FilmTest extends TestCase
{
    public function testCreateFilmObject(): void
    {
        $film = new Film(Uuid::v4(), 'FilmName', 120);

        $this->assertEquals('FilmName', $film->getName());
        $this->assertEquals(120, $film->getDuration());
    }
}
