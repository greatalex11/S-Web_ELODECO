<?php

namespace App\Controller;


use App\Entity\Client;
use App\Entity\Contenus;
use App\Entity\User;
use App\Form\ContactType;
use App\Repository\ClientRepository;
use App\Repository\ContenusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use TheSeer\Tokenizer\TokenCollection;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;


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
    public function login(AuthenticationUtils $authenticationUtils, ClientRepository $clientRepository): Response
    {

        if ($this->getUser()) {
            $id=$this->getUser()->getUserIdentifier();
//          essai recup id
//          $client=$clientRepository->find('user_id');
//          $client=$clientRepository->findOneBy(['user_id' => $id]);
//            dd($id,$client);

            return $this->redirectToRoute('app_client_accueil', [

            ]);
         }

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
//                                                    CONCERVER LES ENTITY REPO POUR UNE DISTRI CONTENU/ PAGE

//                                                    LA DISTIBUTION PERIPHERIQUE SE FAIT PAR LE SERVICE THEME

//  ----------------------------------------------------------------------------------------------------------    HOME

    #[Route(path: '/', name: 'app_home')]
    public function home(ContenusRepository $contenusRepo): Response
    {
        $home = $contenusRepo->findByPagesName('home');
        return $this->render('/pages/home.html.twig', [
            "home" => $home,
        ]);
    }
// ---------------------------------------------------------------------------------------------------   Header Footer
    #[Route(path: '/header', name: 'app_header')]
    public function header(): Response    {
        return $this->render('_partial/_header.html.twig', [
        ]);
    }

    #[Route(path: '/footer', name: 'app_footer')]
    public function footer(): Response
    {
        return $this->render('_partial/_footer.html.twig', [
        ]);
    }

//    #[Route(path: '/side-menu', name: 'app_side-menu')]
//    public function sideMenu(PeripheriquesRepository $repository): Response    {
//        $theme= $repository->findAll();
//        return $this->render('_partial/_side-menu.html.twig', [
//            'theme' =>$theme,
//        ]);
//    }


// ---------------------------------------------------------------------------------------------------------   SERVICES

//    #[Route(path: '/services', name: 'app_services')]
//    public function services(ContenusRepository $contenusRepo): Response
//    {
//        $services = $contenusRepo->findByPagesName('Services');
//        return $this->render('pages/services.html.twig', [
//            "services" => $services,
//        ]);
//
//    }
    #[Route(path: '/services', name: 'app_services')]
    public function servicesGTI(ContenusRepository $contenusRepo): Response    {
        $services = $contenusRepo->findByPagesName('Services');
        return $this->render('pages/services.html.twig', [
            "services" => $services,
        ]);

    }
    #[Route(path: '/services_details', name: 'app_services_details')]
    public function servicesD(ContenusRepository $contenusRepo): Response
    {   $clefs = $contenusRepo->findByType([Contenus::TYPE_SERVICEDETAIL]);
        $services = $contenusRepo->findByType([Contenus::TYPE_ServicesGTI]);
        return $this->render('pages/services_details.html.twig', [
            "serviceD" => $services,
            "clef" => $clefs
               ]);
    }

    #[Route(path: '/services/{slug}', name: 'app_services_slug')]
    public function servicesSlug(Contenus $contenu, ContenusRepository $contenusRepository): Response    {

        //        $service = $contenusRepository->findByType([Contenus::TYPE_ServicesGTI]);

        return $this->render('contenus/_offre_option.html.twig', [
            "service" => $contenu

        ]);
    }


//    #[Route(path: '/services_details/{slug}', name: 'app_services_details2')]
//    public function services(): Response
//    {
//        return $this->render('pages/services_details.html.twig', [
//        ]);
//    }

// ---------------------------------------------------------------------------------------------------------    ABOUT
    #[Route(path: '/about', name: 'app_about')]
    public function about(ContenusRepository $contenusRepo): Response
    {
        $services = $contenusRepo->findByPagesName('About');
        return $this->render('pages/about.html.twig', [
            'about' => $services,
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
// ---------------------------------------------------------------------------------------------------------   Portefolio


    #[Route(path: '/portfolio', name: 'app_portfolio')]
    public function portefolio(ContenusRepository $contenusRepository): Response
    {   $folio = $contenusRepository->findByType([Contenus::TYPE_PortefolioGTI]);
            return $this->render('pages/portfolio.html.twig', [
                'thefolio' => $folio
            ]);
        }
    #[Route(path: '/portfolio/{slug}', name: 'app_portfolio_details2')]
    public function portefolioD(Contenus $contenus ,ContenusRepository $contenusRepository): Response
    {   $folio = $contenusRepository->findByType([Contenus::TYPE_PortefolioGTI]);
//                dd($contenus);
//        foreach($folio as $f => $folios) {
////        dd($folio);
//            if ($folios->getId() === $contenus->getId()) {
//                unset($folio[$f]);
//            }
        return $this->render('pages/portfolio_details.html.twig', [
            'folios' => $folio,
//            'lastfolios'=> $contenus,
        ]);
    }


//    #[Route(path: '/portfolio', name: 'app_portfolio')]
//    public function portefolioD(Contenus $contenus, ContenusRepository $contenusRepository): Response
//    {   $folio = $contenusRepository->findByType([Contenus::TYPE_PortefolioGTI]);
//
//        foreach ($folio as $f => $folios) {
//            if ($folios->getId() === $contenus->getId()) {
//                unset($folio[$f]);
//            }
//            return $this->render('pages/portfolio.html.twig', [
//                'folio' => $folio
//            ]);
//
//        }



//
    #[Route(path: '/portfolio_details', name: 'app_portfolio_details')]
    public function portefolioDP(): Response
    {
        return $this->render('pages/portfolio_details.html.twig', [
        ]);
    }
// -------------------------------------------------------------------------------------------------------    Style déco

    #[Route(path: '/styles', name: 'app_styles')]
    public function styles(): Response
    {
        return $this->render('pages/styles_deco/styles.html.twig', [
        ]);
    }



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


// ....................................................................................................       news


    #[Route(path: '/news', name: 'app_news')]
    public function news(ContenusRepository $contenusRepository): Response
    {
        $news = $contenusRepository->findByType([Contenus::TYPE_BLOGN]);
        return $this->render('pages/news.html.twig', [
            'news' => $news
        ]);
    }

    #[Route(path: '/news/{slug}', name: 'app_news_details')]
    public function newsD(Contenus $contenu, ContenusRepository $contenusRepository): Response
    {
        // Je vais chercher toutes les news publié par date décroissante
        $news = $contenusRepository->findByType([Contenus::TYPE_BLOGN]);
        // Je remove des mes news la news sur laquelle je suis
        foreach ($news as $k => $new) {
            if ($new->getId() === $contenu->getId()) {
                unset($news[$k]);
            }
        }
        return $this->render('pages/news_details.html.twig', [
            "news" => $contenu,
            'lastNews' => $news,
        ]);
    }

// ---------------------------------------------------------------------------------------------------------   CONTACT
    #[Route(path: '/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactType::class);
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
            'form' => $form->createView(),
        ]);
    }

//    #[Route(path: '/client', name: 'app_client')]
//    public function clientView(User $user,Client $client): Response
//    {
//        $id= $user->getId();
//        dd($id);
////        Client $client
////        $user = $this->getUser();
////        $id = $this->getId(); ['user'=>$user]
//        return $this->redirectToRoute('app_client_show',[
//
//        ]);
////        return $this->render('pages/espace_client.html.twig', [
//////            'user'=>$user
////        ]);
//    }

    #[Route(path: '/artisan', name: 'app_artisan')]
    public function artisanView(): Response
    {
        return $this->render('pages/espace_artisan.html.twig', [
        ]);
    }




}
