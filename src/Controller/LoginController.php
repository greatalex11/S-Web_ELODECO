<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
//    #[Route('/login', name: 'app_login')]
//    public function index(): Response
//    {
//        return $this->render('login/index.html.twig', [
//            'controller_name' => 'LoginController',
//        ]);
//    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
//        if ($this->getUser()) {
//            return $this->redirectToRoute('target_path');
//         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    #[Route(path: '/', name: 'app_home')]
    public function home(): Response
    {

        return $this->render('/pages/home.html.twig', [
        ]);
    }

    #[Route(path: '/header', name: 'app_header')]
    public function header(): Response
    {
        return $this->render('_partial/_header.html.twig', [
            'header_phone' => '06ELOPHONE'
        ]);
    }

    #[Route(path: '/footer', name: 'app_footer')]
    public function footer(): Response
    {
        return $this->render('_partial/_footer.html.twig', [
        ]);
    }


    #[Route(path: '/services', name: 'app_services')]
    public function services(): Response
    {
        return $this->render('pages/services.html.twig', [
        ]);
    }
    #[Route(path: '/services_details', name: 'app_services_details')]
    public function servicesD(): Response
    {
        return $this->render('pages/services_details.html.twig', [
        ]);
    }
    #[Route(path: '/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('pages/about.html.twig', [
        ]);
    }
    #[Route(path: '/our_mission', name: 'app_our_mission')]
    public function mission(): Response
    {
        return $this->render('pages/our_mission.html.twig', [
        ]);
    }
    #[Route(path: '/team', name: 'app_team')]
    public function team(): Response
    {
        return $this->render('pages/team.html.twig', [
        ]);
    }

    #[Route(path: '/portfolio', name: 'app_portfolio')]
    public function portefolio(): Response
    {
        return $this->render('pages/portfolio.html.twig', [
        ]);
    }

    #[Route(path: '/portfolio_details', name: 'app_portfolio_details')]
    public function portefolioD(): Response
    {
        return $this->render('pages/portfolio_details.html.twig', [
        ]);
    }
    #[Route(path: '/news', name: 'app_news')]
    public function news(): Response
    {
        return $this->render('pages/news.html.twig', [
        ]);
    }
    #[Route(path: '/news_details', name: 'app_news_details')]
    public function newsD(): Response
    {
        return $this->render('pages/news_details.html.twig', [
        ]);
    }
    #[Route(path: '/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig', [
        ]);
    }
}
