<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    public function addAlbum(
        EntityManagerInterface $entityManager,
        Request $request,
        SluggerInterface $slugger,
        #[Autowire('%kernel.project_dir%/public/uploads')] string $pictureDirectory
    ): Response
    {
        $newAlbum = new Album();
        $formAlbum = $this->createForm(AlbumType::class, $newAlbum);
        $formAlbum ->handleRequest($request);

        if($formAlbum->isSubmitted() && $formAlbum->isValid()){

            // Picture donwload
            $pictureFile = $formAlbum->get('picture')->getData();

            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $pictureFile->move($pictureDirectory, $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                 // updates the 'pictureFilename' property to store the PDF file name
                // instead of its contents
                $newAlbum->setImgPath('uploads/'.$newFilename);
                $newAlbum->setPicture($safeFilename);
            }

            $newAlbum->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($newAlbum);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('album/add.html.twig', [
            'form' => $formAlbum,
        ]);
    }
}
