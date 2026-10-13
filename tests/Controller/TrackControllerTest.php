<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackControllerTest extends WebTestCase
{
    public function testStatusCodeForTrackPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/track');

        $this->assertResponseIsSuccessful();
    }

    public function testStatusCodeForAddingTrackInAlbum(): void
    {
        $client = static::createClient();
        $client->request('GET', '/track-add/1');

        $this->assertResponseIsSuccessful();
    }
}
