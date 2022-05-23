<?php

namespace App\Tests\Domain\Cinema\Entity;

use App\Domain\Cinema\Entity\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

final class ClientTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client(Uuid::v4(), 'Name', '+71234567890');
    }

    public function testGetName(): void
    {
        $this->assertEquals('Name', $this->client->getName());
    }

    public function testGetPhoneNumber(): void
    {
        $this->assertEquals('+71234567890', $this->client->getPhoneNumber());
    }
}
