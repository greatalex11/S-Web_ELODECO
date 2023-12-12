<?php

namespace App\Service;

use App\Entity\Peripheriques;
use App\Repository\PeripheriquesRepository;
use phpDocumentor\Reflection\Types\This;

class LoadThemeService
{
    private ?Peripheriques $theme;
    private PeripheriquesRepository $peripheriquesRepository;

    public function __construct(PeripheriquesRepository $peripheriquesRepository)
    {

        $this->peripheriquesRepository = $peripheriquesRepository;
        $this->theme = $this->peripheriquesRepository->find(1);
    }

    public function theme(): Peripheriques
    {
        return $this->theme;
    }

}