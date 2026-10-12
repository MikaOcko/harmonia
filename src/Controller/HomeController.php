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
        $epType = $albumRepo->findBy(
            ['type' => AlbumType::EP], 
            ['releaseDate' => 'DESC'],
            limit : 12
        );
        $albumType = $albumRepo->findBy(
            ['type' => AlbumType::ALBUM], 
            ['releaseDate' => 'DESC'],
            limit : 12
        );
        $singleType = $albumRepo->findBy(
            ['type' => AlbumType::SINGLE], 
            ['releaseDate' => 'DESC'],
            limit : 12
        );

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
