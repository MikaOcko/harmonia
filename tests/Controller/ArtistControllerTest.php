<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArtistControllerTest extends WebTestCase
{
    public function testStatusCodeForArtistPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/artist');

        $this->assertResponseIsSuccessful();
    }

    public function testStatusCodeForAddingArtist(): void
    {
        $client = static::createClient();
        $client->request('GET', '/artist-add');

        $this->assertResponseIsSuccessful();
    }

    public function testStatusCodeForUpdatingArtist(): void
    {
        $client = static::createClient();
        $client->request('GET', '/artist-edit/1');

        $this->assertResponseIsSuccessful();
    }
}
