<?php

namespace App\Commands;

interface CommandBusInterface
{
    public function execute(CommandInterface $command): mixed;
}