<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StyleControllerTest extends WebTestCase
{
   public function testStatusCodeForStylesPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/style');

        $this->assertResponseIsSuccessful();
    }

    public function testStatusCodeForOneStylePage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/style/blues');

        $this->assertResponseIsSuccessful();
    }
}
