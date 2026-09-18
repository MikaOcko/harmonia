<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/album-add', name: 'app_album_add')]
    public function addAlbum(EntityManagerInterface $entityManager, Request $request): Response
    {
        $newAlbum = new Album();
        $formAlbum = $this->createForm(AlbumType::class, $newAlbum);
        $formAlbum ->handleRequest($request);

        if($formAlbum->isSubmitted() && $formAlbum->isValid()){
            $newAlbum->setCreatedAt(new \DateTimeImmutable());
            // Ajout d'une image (fixe)
            // $newAlbum->setImgPath('uploads/1.jpg');
            $entityManager->persist($newAlbum);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('album/add.html.twig', [
            'form' => $formAlbum,
        ]);
    }
}
