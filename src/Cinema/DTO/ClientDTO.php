<?php

namespace App\Cinema\DTO;

final class ClientDTO
{
    public string $name;

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
