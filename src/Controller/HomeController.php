<?php

namespace App\Controller;

use App\Enum\AlbumType;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AlbumRepository $albumRepo): Response
    {
        $albums = $albumRepo->findAll();
        $epType = $albumRepo->findBy(['type' => AlbumType::EP]);
        $albumType = $albumRepo->findBy(['type' => AlbumType::ALBUM]);
        $singleType = $albumRepo->findBy(['type' => AlbumType::SINGLE]);

        // Retourne l'entité User connecté ou null si pas connecté
        $user = $this->getUser();

        return $this->render('home/index.html.twig', [
            'albums' => $albums,
            'epType' => $epType,
            'albumType' => $albumType,
            'singleType' => $singleType
        ]);
    }
}
