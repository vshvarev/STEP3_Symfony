<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Film;
use App\Entity\MovieSession;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $film1 = new Film();
        $film1->setName('The Dark Knight');
        $film1->setDuration(189);
        $manager->persist($film1);

        $film2 = new Film();
        $film2->setName('Harry Potter and the Deathly Hallows');
        $film2->setDuration(156);
        $manager->persist($film2);

        $client1 = new Client();
        $client1->setName('Vitaliy');
        $client1->setPhoneNumber('89087140477');
        $manager->persist($client1);

        $client2 = new Client();
        $client2->setName('Nastya');
        $client2->setPhoneNumber('89009636457');
        $manager->persist($client2);

        $movieSession1 = new MovieSession();
        $movieSession1->setFilm($film1);
        $movieSession1->setDateTimeStart(date_create_immutable('2022-05-22 20:00:00'));
        $movieSession1->setMaximumCountOfTickets(50);
        $manager->persist($movieSession1);

        $movieSession2 = new MovieSession();
        $movieSession2->setFilm($film2);
        $movieSession2->setDateTimeStart(date_create_immutable('2022-05-22 16:00:00'));
        $movieSession2->setMaximumCountOfTickets(150);
        $manager->persist($movieSession2);

        $manager->flush();
    }
}
