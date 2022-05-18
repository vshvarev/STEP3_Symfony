<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
final class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    private $client;

    #[ORM\ManyToOne(targetEntity: MovieSession::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $movieSession;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getMovieSession(): ?MovieSession
    {
        return $this->movieSession;
    }

    public function setMovieSession(?MovieSession $movieSession): self
    {
        $this->movieSession = $movieSession;

        return $this;
    }
}
