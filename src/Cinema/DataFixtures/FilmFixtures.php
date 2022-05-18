<?php

namespace App\Cinema\DataFixtures;

use App\Cinema\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class FilmFixtures extends Fixture
{
    public const FILM1_REFERENCE = 'film1';
    public const FILM2_REFERENCE = 'film1';

    public function load(ObjectManager $manager): void
    {
        $film1 = new Film('The Dark Knight', 189);
        $manager->persist($film1);

        $film2 = new Film('Harry Potter and the Deathly Hallows', 156);
        $manager->persist($film2);

        $manager->flush();

        $this->setReference(self::FILM1_REFERENCE, $film1);
        $this->setReference(self::FILM2_REFERENCE, $film2);
    }
}
