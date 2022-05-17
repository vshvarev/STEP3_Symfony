<?php

namespace App\Commands;

use App\Entity\MovieSession;

class CreateTicketCommand implements CommandInterface
{
    public function __construct(
        public string $name,
        public string $phoneNumber,
        public MovieSession $movieSession,
    ) {}
}