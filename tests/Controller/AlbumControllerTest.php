<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AlbumControllerTest extends WebTestCase
{
    public function testStatusCodeForAlbumPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/album/1');

        $this->assertResponseIsSuccessful();
    }

        public function testStatusCodeForAddingAlbum(): void
    {
        $client = static::createClient();
        $client->request('GET', '/album-add');

        $this->assertResponseIsSuccessful();
    }
}
