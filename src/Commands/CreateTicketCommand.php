<?php

namespace App\Commands;

use App\Entity\MovieSession;

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
