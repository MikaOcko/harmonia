<?php

namespace App\Controller;

use App\Repository\StyleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StyleController extends AbstractController
{
    #[Route('/style', name: 'app_style')]
    public function index(StyleRepository $styleRepo): Response
    {
        $styles = $styleRepo->findAll();
        dump($styles);

        return $this->render('style/index.html.twig', [
            'styles' => $styles,
        ]);
    }
}
