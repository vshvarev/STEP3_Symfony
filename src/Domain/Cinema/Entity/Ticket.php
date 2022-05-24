<?php

namespace App\Domain\Cinema\Entity;

use App\Domain\Cinema\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: Client::class, cascade: ['persist'])]
    private Client $client;

    #[ORM\ManyToOne(targetEntity: MovieSession::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private MovieSession $movieSession;

    public function __construct(Uuid $id, Client $client, MovieSession $movieSession)
    {
        $this->id = $id;
        $this->client = $client;
        $this->movieSession = $movieSession;
    }
}
