<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\FiltreLocaliteClientRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FiltreLocaliteClientExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('filtreDoc', [$this, 'filtrerDocument']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('function_name', [FiltreLocaliteClientRuntime::class, 'doSomething']),
        ];
    }


    public function filtrerDocument($value)
    {
        $paramFiltre='soing';
        $resultat = array_filter($value, function ($item) use ($paramFiltre) {
            //use ($style) idem global $style
            return $item['localite'] !== $paramFiltre;
        });
        return $resultat;
    }
}









