<?php

namespace App\Domain\Cinema\DataFixtures;

use App\Domain\Cinema\Entity\MovieSession;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

final class MovieSessionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $movieSession1 = new MovieSession(
            Uuid::v4(),
            $this->getReference(FilmFixtures::FILM1_REFERENCE),
            date_create_immutable('2022-05-22 20:00:00'),
            50
        );
        $manager->persist($movieSession1);

        $movieSession2 = new MovieSession(
            Uuid::v4(),
            $this->getReference(FilmFixtures::FILM2_REFERENCE),
            date_create_immutable('2022-05-22 16:00:00'),
            150
        );
        $manager->persist($movieSession2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            FilmFixtures::class,
        ];
    }
}
