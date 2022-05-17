<?php

namespace App\Entity;

use App\Repository\MovieSessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieSessionRepository::class)]
class MovieSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private $dateTimeStart;

    #[ORM\Column(type: 'integer')]
    private $maximumCountOfTickets;

    #[ORM\ManyToOne(targetEntity: Film::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $film;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTimeStart(): ?\DateTimeImmutable
    {
        return $this->dateTimeStart;
    }

    public function setDateTimeStart(\DateTimeImmutable $dateTimeStart): self
    {
        $this->dateTimeStart = $dateTimeStart;

        return $this;
    }

    public function getMaximumCountOfTickets(): ?int
    {
        return $this->maximumCountOfTickets;
    }

    public function setMaximumCountOfTickets(int $maximumCountOfTickets): self
    {
        $this->maximumCountOfTickets = $maximumCountOfTickets;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): self
    {
        $this->film = $film;

        return $this;
    }
}
