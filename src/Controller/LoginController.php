<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

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

    #[Route(path: '/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('pages/about.html.twig', [
        ]);
    }

    #[Route(path: '/portfolio', name: 'app_portfolio')]
    public function portefolio(): Response
    {
        return $this->render('pages/portfolio.html.twig', [
        ]);
    }

}
