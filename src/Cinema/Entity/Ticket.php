<?php

namespace App\Cinema\Entity;

use App\Cinema\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    private Client $client;

    #[ORM\ManyToOne(targetEntity: MovieSession::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private MovieSession $movieSession;

    public function __construct(Client $client, MovieSession $movieSession)
    {
        $this->client = $client;
        $this->movieSession = $movieSession;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function getMovieSession(): ?MovieSession
    {
        return $this->movieSession;
    }
}
