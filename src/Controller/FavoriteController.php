<?php

namespace App\Controller;

use App\Entity\Favorite;
use App\Repository\FavoriteRepository;
use App\Repository\TrackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FavoriteController extends AbstractController
{
    #[Route('/favorite/{id}', name: 'app_favorite')]
    public function addFavorite($id, TrackRepository $trackRepo, FavoriteRepository $favoriteRepo, EntityManagerInterface $entityManager): Response
    {   
        // Retrieve user
        $user = $this->getUser();
        // Check connected user
        if($user === null){
            return $this->redirectToRoute('app_login');
        }

        // Retrieve track by her id
        $track = $trackRepo->find($id);
        
        // Check existing favorite
        $favorite = $favoriteRepo->findOneBy([
            'user' => $user,
            'track' => $track,
        ]);

        if($favorite === null){
            // Add to favorites
            $favorite = new Favorite();
            $favorite->setCreatedAt(new \DateTimeImmutable());
            $favorite 
                ->setTrack($track)
                ->setUser($user);
            $entityManager->persist($favorite);
        } else {
            // Remove to favorites
            $entityManager->remove($favorite);
        }
            
        $entityManager->flush();

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }
}
