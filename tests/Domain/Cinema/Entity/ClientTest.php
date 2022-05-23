<?php

namespace App\Tests\Domain\Cinema\Entity;

use App\Domain\Cinema\Entity\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

final class ClientTest extends TestCase
{
    public function testCreateClientObject(): void
    {
        $client = new Client(Uuid::v4(), 'Name', '+71234567890');

        $this->assertEquals('Name', $client->getName());
        $this->assertEquals('+71234567890', $client->getPhoneNumber());
    }
}
