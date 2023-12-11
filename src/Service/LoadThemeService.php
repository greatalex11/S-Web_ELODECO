<?php

namespace App\Service;

use App\Entity\Peripheriques;
use App\Repository\PeripheriquesRepository;

class LoadThemeService
{
    private ?Peripheriques $theme;
    private PeripheriquesRepository $peripheriquesRepository;

    public function __construct(PeripheriquesRepository $peripheriquesRepository)
    {

        $this->peripheriquesRepository = $peripheriquesRepository;
        $this->theme = $this->peripheriquesRepository->find(1);
    }

    public function theme()
    {
        $this->theme;
    }
}