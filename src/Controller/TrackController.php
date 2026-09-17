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

final class TrackController extends AbstractController
{
    #[Route('/track', name: 'app_track')]
    public function index(TrackRepository $trackRepo): Response
    {
        $tracks = $trackRepo->findAll();
        dump($tracks);

        return $this->render('track/index.html.twig', [
            'tracks' => $tracks,
        ]);
    }

    #[Route('/track-add', name: 'app_track_add')]
    public function addTrack(EntityManagerInterface $entityManager, Request $request): Response
    {
        $newTrack = new Track();

        $formTrack = $this->createForm(TrackType::class, $newTrack);
        $formTrack->handleRequest($request);

        if($formTrack->isSubmitted() && $formTrack->isValid()){
            $newTrack->setCreatedAt(new \DateTimeImmutable());
            $newTrack->setListeningCounter(0);
            $entityManager->persist($newTrack);
            $entityManager->flush();

            return $this->redirectToRoute('app_track');
        }

        return $this->render('track/add.html.twig', [
            'form' => $formTrack,
        ]);
    }
}
