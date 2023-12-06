<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Entity\Contenus;
use App\Form\ContactType;
use App\Repository\ContenusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Request;

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

//  ----------------------------------------------------------------------------------------------------------   HOME

    #[Route(path: '/', name: 'app_home')]
    public function home(ContenusRepository $contenusRepo): Response
    {
        $home = $contenusRepo->findByPagesName('home');
//       $homeCompteurs=$contenusRepo->findCompteurs('homeCompteurs', [Contenus::TYPE_COMPTEURS]);
//       dd($home);
        return $this->render('/pages/home.html.twig', [
            "home" => $home,
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
// ---------------------------------------------------------------------------------------------------------   SERVICES

    #[Route(path: '/services', name: 'app_services')]
    public function services(ContenusRepository $contenusRepo): Response
    {
        $services = $contenusRepo->findByPagesName('services');
//        dd($services);
        return $this->render('pages/services.html.twig', [
            "services" => $services,
        ]);

    }

    #[Route(path: '/services_details', name: 'app_services_details')]
    public function servicesD(): Response
    {
        return $this->render('pages/services_details.html.twig', [
        ]);
    }
// ---------------------------------------------------------------------------------------------------------    ABOUT
    #[Route(path: '/about', name: 'app_about')]
    public function about(ContenusRepository $contenusRepo): Response
    {
        $services = $contenusRepo->findByPagesName('About');
        return $this->render('pages/about.html.twig', [
            'about'=>$services,
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

    #[Route(path: '/styles', name: 'app_styles')]
    public function styles(): Response
    {
        return $this->render('pages/styles_deco/styles.html.twig', [
        ]);
    }

//                                                                                               STYLES DETAILS

    #[Route(path: '/styles_scandinav', name: 'app_styles_scandinav')]
    public function stylesScandinav(): Response
    {
        return $this->render('pages/styles_deco/styles_details_scandinav.html.twig', [
        ]);
    }


    #[Route(path: '/styles_contemporain', name: 'app_styles_contemporain')]
    public function stylesContemporain(): Response
    {
        return $this->render('pages/styles_deco/styles_details_contemporain.html.twig', [
        ]);
    }


//                                                                                               FIN STYLES DETAILS
    #[Route(path: '/portfolio_details', name: 'app_portfolio_details')]
    public function portefolioD(): Response
    {
        return $this->render('pages/portfolio_details.html.twig', [
        ]);
    }

    #[Route(path: '/news', name: 'app_news')]
    public function news(ContenusRepository $contenusRepository): Response
    {
        $news = $contenusRepository->findByPagesName('News', [Contenus::TYPE_NEWS]);
//        dd($news);
        return $this->render('pages/news.html.twig', [
        ]);
    }

    #[Route(path: '/news/{id}', name: 'app_news_details')]
    public function newsD(): Response
    {
        // recup la news
        return $this->render('pages/news_details.html.twig', [
        ]);
    }
// ---------------------------------------------------------------------------------------------------------   CONTACT
    #[Route(path: '/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm( ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
//            dd($data);
//            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();
            // **** form a CLEANER        *******/

        }
//        return $this->redirectToRoute('app_contact', [], Response::HTTP_SEE_OTHER);
        return $this->render('pages/contact.html.twig', [
            'form'=>$form ->createView(),
        ]);
    }

    #[Route(path: '/client', name: 'app_client')]
    public function clientView(): Response
    {
        return $this->render('pages/espace_client.html.twig', [
        ]);
    }

    #[Route(path: '/artisan', name: 'app_artisan')]
    public function artisanView(): Response
    {
        return $this->render('pages/espace_artisan.html.twig', [
        ]);
    }




}
