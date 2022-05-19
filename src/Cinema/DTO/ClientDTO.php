<?php

namespace App\Cinema\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class ClientDTO
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\NotBlank]
    public string $phoneNumber;

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
