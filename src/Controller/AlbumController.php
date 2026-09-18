<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AlbumController extends AbstractController
{
    #[Route('/album/{id}', name: 'app_album')]
    public function index($id, AlbumRepository $albumRepo): Response
    {
        $album = $albumRepo->find($id);

        if($album === null){
            return $this->redirectToRoute('app_home');
        }

        return $this->render('album/index.html.twig', [
            'album' => $album,
        ]);
    }
}
