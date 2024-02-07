<?php

namespace App\Controller;


use App\Entity\ContactForm;
use App\Entity\Contenus;
use App\Entity\Projet;
use App\Entity\Style;
use App\Form\ContactType;
use App\Repository\AboutRepository;
use App\Repository\ClientRepository;
use App\Repository\ContenusRepository;
use App\Repository\MissionRepository;
use App\Repository\ProjetRepository;
use App\Repository\StyleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, ClientRepository $clientRepository): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
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
    public function header(): Response
    {
        return $this->render('_partial/_header.html.twig', [
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
    public function servicesGTI(ContenusRepository $contenusRepo): Response
    {
        $services = $contenusRepo->findByPagesName('Services');
        return $this->render('pages/services.html.twig', [
            "services" => $services,
        ]);

    }

//  MODFIF POUR VUE GLOBALE + VUE DETAILLE
    #[Route(path: '/services_details/{slug}', name: 'app_services_details')]
    public function servicesD(Contenus $contenu, ContenusRepository $contenusRepo): Response
    {

        $clefs = $contenusRepo->findByType([Contenus::TYPE_CLEFSERVICEDETAIL]);
        $services = $contenusRepo->findByPagesName('services_details');
        $promo=$contenusRepo->findByType([Contenus::TYPE_PROMOSERVICEDETAIL]);

        $servicesGTI = $contenusRepo->findByType([Contenus::TYPE_ServicesGTI]);
        $result = array_filter($servicesGTI, function($item) use ($contenu) {
            //use ($contenu) idem global $contenu
            return $item->getId() !== $contenu->getId();
        });


        return $this->render('pages/services_details.html.twig', [
            "serviceSlug"=> $contenu,
            "clef" => $clefs,
            "serviceFiltres"=>$result,
            "serviceD" => $services,
            "promoServices" => $promo,
            "serviceGTI"=>$servicesGTI,
        ]);

//        $servicesGTI = $contenusRepo->findByType([Contenus::TYPE_ServicesGTI]);
//        $filterServices = function ($servicesGTI, $callback):array {
//            $result = [];
//            foreach ($servicesGTI as $k => $item) if ($callback($item)) {
//                $result[$k] = $item;
//            }
//            return $result;
//        };
//
//        dd($filterServices);


    }
//
//    #[Route(path: '/services/{slug}', name: 'app_services_slug')]
//    public function servicesSlug(Contenus $contenu, ContenusRepository $contenusRepository): Response
//    {
//
//        //        $service = $contenusRepository->findByType([Contenus::TYPE_ServicesGTI]);
//
//        return $this->render('contenus/_offre_option.html.twig', [
//            "service" => $contenu
//
//        ]);
//    }


// ---------------------------------------------------------------------------------------------------------    ABOUT
    #[Route(path: '/about', name: 'app_about')]
    public function about(ContenusRepository $contenusRepo, AboutRepository $aboutRepository): Response
    {
        $about=$aboutRepository->find(['id'=>1]);
        $services = $contenusRepo->findByPagesName('About');
        return $this->render('pages/about.html.twig', [
            'about' => $services,
            'visio'=>$about,
        ]);
    }

    #[Route(path: '/ma_mission', name: 'app_our_mission')]
    public function mission(MissionRepository $missionRepository): Response
    {

        $mission=$missionRepository->find(['id'=>1]);
        $listing=$missionRepository-> findByListe();
        $listed=$listing[0];

//      $listing=null;
//      $missionnee=null;
//        foreach ( $mission as $missionnee){
//            $missionnee= json_decode($mission['liste']);
//        foreach ( $missionnee as $k=>$v){
//            $listing=[$missionnee[$k]=>$missionnee[$v]];
//       } dd($listing);

        return $this->render('pages/our_mission.html.twig', [
            'mission'=>$mission,
            'liste1'=>$listed,
        ]);
    }


// ---------------------------------------------------------------------------------------------------------   PROJETS


    #[Route(path: '/projets', name: 'app_projets')]
    public function projets(ProjetRepository $projetRepository): Response
    {
        $projets= $projetRepository->findAll();
        return $this->render('pages/projets.html.twig', [
            "projets" => $projets,
        ]);
    }

    #[Route(path: '/projet_details/{slug}', name: 'app_projet_details')]
    public function projetDetails (Projet $projet, ProjetRepository $projetRepository): Response
    {
        $projetActuel=$projet;
        $projetsAll = $projetRepository->findAll();
        $stylesFilter = array_filter($projetsAll, function($item) use ($projet) {
            //use ($style) idem global $style
            return $item->getId() !== $projet->getId();
        });

        return $this->render('pages/projet_details.html.twig', [
            'projetActuel'=>$projetActuel,
            'projetsFilter'=>$stylesFilter,
        ]);
    }



    #[Route(path: '/portfolio', name: 'app_portfolio')]
    public function portefolio(ContenusRepository $contenusRepository): Response
    {
        $folio = $contenusRepository->findByType([Contenus::TYPE_PortefolioGTI]);
        return $this->render('pages/portfolio.html.twig', [
            'thefolio' => $folio
        ]);
    }
//
//    #[Route(path: '/portfolio/{slug}', name: 'app_portfolio_details2')]
//    public function portefolioD(Contenus $contenus, ContenusRepository $contenusRepository): Response
//    {
//        $folio = $contenusRepository->findByType([Contenus::TYPE_PortefolioGTI]);
//
//        return $this->render('pages/portfolio_details.html.twig', [
//            'folios' => $folio,
////            'lastfolios'=> $contenus,
//        ]);
//    }
//
//    #[Route(path: '/portfolio_details', name: 'app_portfolio_details')]
//    public function portefolioDP(): Response
//    {
//        return $this->render('pages/portfolio_details.html.twig', [
//        ]);
//    }

// -------------------------------------------------------------------------------------------------------    Style déco

    #[Route(path: '/styles', name: 'app_styles')]
    public function styles(StyleRepository $styleRepository): Response
    {
        $styles= $styleRepository->findByPagesName('styles');
        return $this->render('pages/styles_deco/styles.html.twig', [
            "style" => $styles,
        ]);
    }


    #[Route(path: '/styles_details/{slug}', name: 'app_styles_details')]
    public function stylesDetail(Style $style, StyleRepository $styleRepository): Response
    {
        $styleActuel=$style;
        $stylesAll = $styleRepository->findAll();
        $stylesFilter = array_filter($stylesAll, function($item) use ($style) {
            //use ($style) idem global $style
            return $item->getId() !== $style->getId();
        });

        return $this->render('pages/styles_deco/styles_details.html.twig', [
            'styled'=>$styleActuel,
            'styleFilter'=>$stylesFilter,
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
    #[Route(path: '/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function contact(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message_send = false;
        $contact = new ContactForm();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setDateCreation(new \DateTime());
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', 'Votre message a bien été envoyé. Merci.');
            $message_send = true;
            return $this->redirectToRoute('app_contact');
            };

        return $this->render('pages/contact.html.twig', [
            'form' => $form->createView(),
            'message_send' => $message_send
        ]);
    }
}
