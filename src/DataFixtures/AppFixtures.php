<?php

namespace App\DataFixtures;

use App\Entity\Favorite;
use App\Entity\Style;
use App\Factory\AlbumFactory;
use App\Factory\ArtistFactory;
use App\Factory\FavoriteFactory;
use App\Factory\ListeningLogFactory;
use App\Factory\PlaylistFactory;
use App\Factory\StyleFactory;
use App\Factory\TrackFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Artist fixture
        ArtistFactory::createMany(20);
        // Style fixture
        // StyleFactory::createMany(5);
        $genres = ['rock','reggae','classique', 'jazz', 'pop', 'hip-hop', 'electro', 'blues', 'metal', 'funk', 'soul', 'country', 'folk', 'punk', 'disco', 'rnb', 'rap', 'house', 'techno', 'ambient', 'salsa', 'bossa nova', 'ska', 'gospel', 'grime', 'dubstep', 'afrobeats', 'drill', 'synthwave'];
        foreach ($genres as $value) {
            StyleFactory::createOne([
                'name' => $value
            ]);
        };
        // User fixture
        UserFactory::createMany(30);
        // Album fixture
        AlbumFactory::createMany(20);
        // Tracks fixture
        TrackFactory::createMany(50);
        // Favorite fixture
        FavoriteFactory::createMany(20);
        // ListeningLog fixture
        ListeningLogFactory::createMany(100);
        // Playlist fixture
        PlaylistFactory::createMany(6);

        $manager->flush();
    }
}
