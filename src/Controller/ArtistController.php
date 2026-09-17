<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function index(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findAll();

        return $this->render('artist/index.html.twig', [
            'artists' => $artists,
        ]);
    }

    #[Route('/artist-add', name: 'app_artist_add')]
    public function addArtist(): Response
    {

        return $this->render('artist/index.html.twig', [

        ]);
    }

    #[Route('/artist-edit', name: 'app_artist_edit')]
    public function editArtist(): Response
    {

        return $this->render('artist/index.html.twig', [

        ]);
    }
}
