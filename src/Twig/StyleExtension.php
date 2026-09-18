<?php

namespace App\Twig;

use App\Repository\StyleRepository;
use Twig\Attribute\AsTwigFilter;
use Twig\Attribute\AsTwigFunction;

final class StyleExtension
{

    public function __construct(
        private StyleRepository $styleRepo
    ){

    }

    // If your filter generates SAFE HTML, you should add the "isSafe" argument:
    // #[AsTwigFilter(name: 'filter_name', isSafe: ['html'])]
    // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
    #[AsTwigFilter('filter_name')]
    public function doSomething(string $value): string
    {
        // ...

        return $value;
    }

    #[AsTwigFunction('get_styles')]
    public function getStyles(): array
    {
        $styles = $this->styleRepo->findAll();

        return $styles;
    }
}
