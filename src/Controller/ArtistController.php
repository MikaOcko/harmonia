<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function addArtist(EntityManagerInterface $entityManager, Request $request): Response
    {
        $newArtist = new Artist();
        $formArtist = $this->createForm(ArtistType::class, $newArtist);
        $formArtist->handleRequest($request);

        if($formArtist->isSubmitted() && $formArtist->isValid()){
            $newArtist->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($newArtist);
            $entityManager->flush();

            return $this->redirectToRoute('app_artist');
        }

        return $this->render('artist/add.html.twig', [
            'form' => $formArtist,
        ]);
    }

    #[Route('/artist-edit/{id}', name: 'app_artist_edit')]
    public function editArtist($id, EntityManagerInterface $entityManager, Request $request, ArtistRepository $artistRepo): Response
    {
        $artist = $artistRepo->find($id);
        dump($artist);

        $formArtist = $this->createForm(ArtistType::class, $artist);
        $formArtist->handleRequest($request);

        if($formArtist->isSubmitted() && $formArtist->isValid()){
            $entityManager->persist($artist);
            $entityManager->flush();

            return $this->redirectToRoute('app_artist');
        }
        
        return $this->render('artist/edit.html.twig', [
            'form' => $formArtist,
        ]);
    }
}
