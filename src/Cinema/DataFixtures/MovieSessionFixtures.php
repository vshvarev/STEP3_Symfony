<?php

namespace App\Cinema\DataFixtures;

use App\Cinema\Entity\MovieSession;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class MovieSessionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movieSession1 = new MovieSession(
            $this->getReference(FilmFixtures::FILM1_REFERENCE),
            date_create_immutable('2022-05-22 20:00:00'),
            50
        );
        $manager->persist($movieSession1);

        $movieSession2 = new MovieSession(
            $this->getReference(FilmFixtures::FILM2_REFERENCE),
            date_create_immutable('2022-05-22 16:00:00'),
            150
        );
        $manager->persist($movieSession2);

        $manager->flush();
    }
}
