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

    #[Route('/style/{name}', name: 'app_style_name')]
    public function getStyle(string $name, StyleRepository $styleRepo): Response
    {
        $style = $styleRepo->findOneBy([
            'name' => $name,
        ]);

        return $this->render('style/read.html.twig', [
            'style' => $style,
        ]);
    }
    
}
