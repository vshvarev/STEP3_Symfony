<?php

namespace App\Domain\Cinema\Command;

use App\Domain\Cinema\Entity\MovieSession;

final class CreateTicketCommand
{
    public function __construct(
        public string $name,
        public string $phoneNumber,
        public MovieSession $movieSession,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getMovieSession(): MovieSession
    {
        return $this->movieSession;
    }
}
