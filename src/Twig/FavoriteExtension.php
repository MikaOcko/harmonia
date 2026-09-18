<?php

namespace App\Twig;

use App\Entity\Track;
use App\Entity\User;
use App\Repository\FavoriteRepository;
use Twig\Attribute\AsTwigFilter;
use Twig\Attribute\AsTwigFunction;

final class FavoriteExtension
{

    public function __construct(
        private FavoriteRepository $favoriteRepository
    )
    {
    }


    // If your filter generates SAFE HTML, you should add the "isSafe" argument:
    // #[AsTwigFilter(name: 'filter_name', isSafe: ['html'])]
    // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
    #[AsTwigFilter('filter_name')]
    public function doSomething(string $value): string
    {
        // ...

        return $value;
    }

    #[AsTwigFunction('is_user_add_track_in_favorite')]
    public function isUserAddTrackInFavorite(?User $user, Track $track): bool
    {
        if($user === null){
            return false;
        }

        $favoriteEntity = $this->favoriteRepository->findOneBy(['user' => $user, 'track' =>$track]);

        if($favoriteEntity !== null){
            return true;
        } else {
            return false;
        }
        // foreach($user->getFavorites() as $favorite){
        //     if($favorite->getTrack()->getId() === $track->getId()){
        //         return true;
        //     }
        // }

    }
}
