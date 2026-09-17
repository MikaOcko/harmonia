<?php

namespace App\Controller;

use App\Entity\Track;
use App\Repository\TrackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\TrackType;
use App\Repository\AlbumRepository;

final class TrackController extends AbstractController
{
    #[Route('/track', name: 'app_track')]
    public function index(TrackRepository $trackRepo): Response
    {
        $tracks = $trackRepo->findAll();

        return $this->render('track/index.html.twig', [
            'tracks' => $tracks,
        ]);
    }

    #[Route('/track-add/{id}', name: 'app_track_add')]
    public function addTrack($id, EntityManagerInterface $entityManager, Request $request, AlbumRepository $albumRepo): Response
    {
        $album = $albumRepo->find($id);
        $newTrack = new Track();

        $formTrack = $this->createForm(TrackType::class, $newTrack);
        $formTrack->handleRequest($request);

        if($formTrack->isSubmitted() && $formTrack->isValid()){
            $newTrack->setCreatedAt(new \DateTimeImmutable());
            $newTrack->setListeningCounter(0);
            $newTrack->setAlbum($album);
            $entityManager->persist($newTrack);
            $entityManager->flush();

            return $this->redirectToRoute('app_album', ['id'=> $album->getId()]);
        }

        return $this->render('track/add.html.twig', [
            'form' => $formTrack,
        ]);
    }
}
