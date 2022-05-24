<?php

namespace App\Domain\Cinema\Entity;

use App\Domain\Cinema\Repository\MovieSessionRepository;
use DateInterval;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: MovieSessionRepository::class)]
class MovieSession
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: Film::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Film $film;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $dateTimeStart;

    #[ORM\Column(type: 'integer')]
    private int $maximumCountOfTickets;

    #[ORM\OneToMany(mappedBy: 'movieSession', targetEntity: Ticket::class, cascade: ['persist'])]
    private Collection $tickets;

    #[Pure]
    public function __construct(Uuid $id, Film $film, DateTimeImmutable $dateTimeStart, int $maximumCountOfTickets)
    {
        $this->id = $id;
        $this->film = $film;
        $this->dateTimeStart = $dateTimeStart;
        $this->maximumCountOfTickets = $maximumCountOfTickets;
        $this->tickets = new ArrayCollection();
    }

    public function getFormatTimeEnd(): string
    {
        $duration = DateInterval::createFromDateString("+{$this->getFilmDuration()} minutes");
        $dateTimeEnd = $this->dateTimeStart->add($duration);

        return $dateTimeEnd->format('H:i');
    }

    public function getFilmDuration(): int
    {
        return $this->getFilm()->getDuration();
    }

    public function getFormatTimeStart(): string
    {
        return $this->dateTimeStart->format('H:i');
    }

    public function getFormatDateStart(): string
    {
        return $this->dateTimeStart->format('d F Y');
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getDateTimeStart(): ?DateTimeImmutable
    {
        return $this->dateTimeStart;
    }

    public function getMaximumCountOfTickets(): ?int
    {
        return $this->maximumCountOfTickets;
    }

    public function getCountOfRemainingTickets(): int
    {
        return $this->getMaximumCountOfTickets() - count($this->getTickets());
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket)
    {
        $this->tickets->add($ticket);
    }
}
