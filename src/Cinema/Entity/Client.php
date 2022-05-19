<?php

namespace App\Cinema\Entity;

use App\Cinema\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $phoneNumber;

    public function __construct(Uuid $id, string $name, string $phoneNumber)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }
}
