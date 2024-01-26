<?php

namespace App\Controller\Admin;

use App\Entity\Artisan;
use App\Entity\Client;
use App\Entity\Contenus;
use App\Entity\Documents;
use App\Entity\Image;
use App\Entity\Page;
use App\Entity\Projet;
use App\Entity\Style;
use App\Entity\Tache;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ContenusCrudController::class)->generateUrl();

        return $this->redirect($url);


//       ESSAIS IMPORT DATE DU JOUR :  $date = date('r');
//        $urlWithDate = sprintf("%s?date=%s", $url, $date);
//        return $this->redirect($urlWithDate);

//           return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend

//        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
//        return $this->redirect($adminUrlGenerator->setController(ContenusCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }


    public function configureDashboard(): Dashboard
    {
        $date = date('r');
        return Dashboard::new()
            ->setTitle('ELO DECO ADMINISTRATION')
            ->renderContentMaximized();
//        'user'->$this->getUser();
    }

    public function configureMenuItems(): iterable
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);

        yield MenuItem::linkToUrl('EloDeco Site Web', 'fas fa-home', $this->generateUrl('app_home'));
        yield MenuItem::section('Thème');
        yield MenuItem::linkToCrud('Pages', 'fas fa-file-alt', Page::class);
        yield MenuItem::linkToCrud('Contenus', 'fas fa-text-height', Contenus::class);
        yield MenuItem::linkToCrud('Styles', 'fa-brands fa-stack-overflow', Style::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-image', Image::class);

        // Pour le thème je charge ma seule entité en base de données en mode édition
        yield MenuItem::linkToUrl('Theme', 'fas fa-suse', $routeBuilder
            ->setController(PeripheriquesCrudController::class)
            ->setEntityId(1)
            ->setAction(Action::EDIT));

        yield MenuItem::section('Admin');
        yield MenuItem::linkToCrud('Artisans', 'fas fa-hammer', Artisan::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-users', Client::class);
        yield MenuItem::linkToCrud('Roles', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Projets', 'fas fa-project-diagram', Projet::class);
        yield MenuItem::linkToCrud('taches', 'fas fa-project-diagram', Tache::class);
        yield MenuItem::linkToCrud('Documents', 'fas fa-project-diagram', Documents::class);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER)
            ->remove(Crud::PAGE_INDEX, Action::BATCH_DELETE);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUserIdentifier())
            ->displayUserAvatar(false);
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets();
    }

}
