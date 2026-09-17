<?php

namespace App\Controller;

use App\Entity\Favorite;
use App\Repository\FavoriteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FavoriteController extends AbstractController
{
    #[Route('/addFavorite/{id}', name: 'app_favorite')]
    public function index($id, FavoriteRepository $favoriteRepo): Response
    {
        $newFavorite = new Favorite;
        $newFavorite = $this->setTrack($track);
        $user = $this->getUser();
        $newFavorite = $this->setUser($user);
        // if($user === null){
        //     return $this->redirectToRoute('app_home');
        // }

        return $this->render('favorite/index.html.twig', [
            'user' => $user,
        ]);
    }
}
