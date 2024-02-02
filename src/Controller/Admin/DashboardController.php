<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Entity\Artisan;
use App\Entity\Client;
use App\Entity\ContactForm;
use App\Entity\Contenus;
use App\Entity\Documents;
use App\Entity\Image;
use App\Entity\Page;
use App\Entity\Projet;
use App\Entity\Style;
use App\Entity\Tache;
use App\Entity\User;
use App\Repository\ContactFormRepository;
use App\Service\countMsg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use phpDocumentor\Reflection\Types\String_;
use PHPUnit\Framework\Constraint\Count;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class DashboardController extends AbstractDashboardController
{


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ContenusCrudController::class)->generateUrl();



//            public function __construct(ContactFormRepository $contactFormRepository)
//            {
//                $msg=$contactFormRepository->countMsg();
//
//                return $msg;
//            }




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



    public function __construct(countMsg $msg)
    {
        $this->msg = $msg;
    }


    public function configureMenuItems(): iterable
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);

        yield MenuItem::linkToUrl('EloDeco Site Web', 'fas fa-home', $this->generateUrl('app_home'));


        yield MenuItem::section('Mes contacts');
        yield MenuItem::linkToCrud('Messages', 'fa-brands fa-square-threads', ContactForm::class)
        ->setBadge(  $this->msg);
//        ->setAction(count('message'));

        yield MenuItem::section('Thème');
        // Pour le thème je charge ma seule entité en base de données en mode édition
        yield MenuItem::linkToUrl('Theme', 'fa-brands fa-suse', $routeBuilder
            ->setController(PeripheriquesCrudController::class)
            ->setEntityId(1)
            ->setAction(Action::EDIT));

        yield MenuItem::linkToCrud('Styles déco', 'fa-brands fa-stack-overflow', Style::class);
        yield MenuItem::linkToCrud('A propos', 'fa-brands fa-stack-overflow', About::class);

        yield MenuItem::linkToCrud('Contenus', 'fas fa-text-height', Contenus::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-image', Image::class);
        yield MenuItem::linkToCrud('Pages', 'fas fa-file-alt', Page::class);


        yield MenuItem::section('Métier');
        yield MenuItem::linkToCrud('Projets', 'fas fa-project-diagram', Projet::class);
        yield MenuItem::linkToCrud('taches', 'fas fa-project-diagram', Tache::class);
        yield MenuItem::linkToCrud('Documents', 'fas fa-project-diagram', Documents::class);

        yield MenuItem::section('Admin');
        yield MenuItem::linkToCrud('Artisans', 'fas fa-hammer', Artisan::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-users', Client::class);
        yield MenuItem::linkToCrud('Roles', 'fa-brands fa-slack', User::class);

    }

    public function configureActions(): Actions
    {
//        $em=$this->getDoctrine()->
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

//    private function countMsg(ContactFormRepository $contactFormRepository)
//    {
//        $em=$this->countMsg();
//    }

}
