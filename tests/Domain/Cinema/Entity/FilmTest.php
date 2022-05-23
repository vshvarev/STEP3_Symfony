<?php

namespace App\Tests\Domain\Cinema\Entity;

use App\Domain\Cinema\Entity\Film;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

final class FilmTest extends TestCase
{
    private Film $film;

    protected function setUp(): void
    {
        $this->film = new Film(Uuid::v4(), 'FilmName', 120);
    }

    public function testGetName(): void
    {
        $this->assertEquals('FilmName', $this->film->getName());
    }

    public function testGetDuration(): void
    {
        $this->assertEquals(120, $this->film->getDuration());
    }
}
