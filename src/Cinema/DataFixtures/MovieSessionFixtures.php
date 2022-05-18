<?php

namespace App\Cinema\DataFixtures;

use App\Cinema\Entity\MovieSession;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class MovieSessionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movieSession1 = new MovieSession();
        $movieSession1->setFilm($this->getReference(FilmFixtures::FILM1_REFERENCE));
        $movieSession1->setDateTimeStart(date_create_immutable('2022-05-22 20:00:00'));
        $movieSession1->setMaximumCountOfTickets(50);
        $manager->persist($movieSession1);

        $movieSession2 = new MovieSession();
        $movieSession2->setFilm($this->getReference(FilmFixtures::FILM2_REFERENCE));
        $movieSession2->setDateTimeStart(date_create_immutable('2022-05-22 16:00:00'));
        $movieSession2->setMaximumCountOfTickets(150);
        $manager->persist($movieSession2);

        $manager->flush();
    }
}
