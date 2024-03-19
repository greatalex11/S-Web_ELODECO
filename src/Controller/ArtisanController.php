<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Entity\Documents;
use App\Entity\User;
use App\Form\ArtisanType;
use App\Form\DocumentsType;
use App\Form\SearchFormType;
use App\Repository\DocumentsRepository;
use App\Repository\ProjetRepository;
use App\Repository\TacheRepository;
use App\Service\searchFunction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_ARTISAN')]
#[Route('/artisan_accueil')]
class ArtisanController extends AbstractController
{

 // injection du service searchFunction -> lorsque la config service yaml sera corrigée
    // Cannot autowire service "App\Service\searchFunction": argument "$projetList" of method "__construct()" is type-hinted "array", you should configure its value explicitly.
//    public function __construct(searchFunction $searchFunction)
//    {
//        $this->searchFunction = $searchFunction;
//    }


    // ..............................................................................................  accueil  artisan'
    #[Route('/{id}', name: 'app_artisan_accueil', methods: ['GET'])]
    public function index(Artisan $artisan): Response
    {
       $artisans = $artisan;
        return $this->render('pages/espace_artisan.html.twig', [
            'artisans' => $artisans,
        ]);
    }


    // ...........................................DOCUMENTS....................................... page accueil document

    #[Route('/{id}/{doc}', name: 'app_artisan_accueilDoc', methods: ['GET', 'POST'])]
    public function indexDoc(Artisan $artisan,DocumentsRepository $documentsRepository,EntityManagerInterface $entityManager,SluggerInterface $slugger,Request $request): Response
    {
        $id=$artisan->getId();
        $artisans = $artisan;
        $doc = $request->get('doc');
        if ($doc) {
           $idArtisan=$id;
           $documentIdArtisan=$documentsRepository-> findDocumentArtisan($idArtisan); //dql depuis document
           if(!$documentIdArtisan){
               $this->addFlash(
                   'notice',
                   'Vous n\'avez pas encore de document en ligne.'
               );
           }

           //formulaire search document
           $search = new SearchFormType();
           $formSearch = $this->createForm(SearchFormType::class, $search);
           $formSearch->handleRequest($request);
           if ($formSearch->isSubmitted() && $formSearch->isValid()) {
               $search = $formSearch->get('searchValue')->getData();
               //search fonction à faire
           }


///  //formulaire upload depuis FormType bidouillée en document et ici
//            $formType = new $formType();
//            $formType->setDocumentsFile('Nouveau document');
//
//            $form = $this->createForm($formType, null, $formOptions);
//            $form->handleRequest($request);
//               if ($form->isSubmitted() && $form->isValid()) {
//                   /** @var documents $documents */
//                   $File = $form->get('documentsFile')->getData();
//                   $entityManager->persist($File);
//                   $entityManager->flush();
//                   $this->addFlash('success', 'Votre document est bien enregistré');
//               }

       //     /** @var documents $documents */

         //  $documents = new $documents();
////         $documents->setDocument('nouveau document');
//           $formDoc=$this->createForm(DocumentsType::class, $documents);
//            if ($formDoc->isSubmitted() && $formDoc->isValid()) {
//                $File = $formDoc->get('documentsFile')->getData();
//                // this condition is needed because the 'documentsFile' field is not required
//                // so the PDF file must be processed only when a file is uploaded
//
//                if ($File) {
//                    $originalFilename = pathinfo($File->getClientOriginalName(), PATHINFO_FILENAME);
//                    // this is needed to safely include the file name as part of the URL
//                    $safeFilename = $slugger->slug($originalFilename);
//                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $File->guessExtension();
//
//                    // Move the file to the directory where brochures are stored
//                    try {
//                        $File->move(
//                            $this->getParameter('brochures_directory'),
//                            $newFilename
//                        );
//                    } catch (FileException $e) {
//                        // ... handle exception if something happens during file upload
//                    }
//
//                    // updates the 'brochureFilename' property to store the PDF file name
//                    // instead of its contents
//                    $documents->setDocument(($newFilename));
//                }
//                $entityManager->persist($File);
//                $entityManager->flush();
//                $this->addFlash('success', 'Votre document est bien enregistré');
//            }

            return $this->render('pages/espace_artisan.html.twig', [
                'id' => $id,
                'artisans' => $artisans,
                'documentIdArtisan' => $documentIdArtisan,
                'formSearch' => $formSearch->createView(),
//                'formLoadDoc'=>$formDoc,
//                'form2'=>$form2,
            ]);
       }
        return $this->render('pages/espace_artisan.html.twig', [
            'artisans' => $artisans,
        ]);
    }

    // ...............................................Choix idArtisan/  dqg liste - documents href 'document-id artisan'
    #[Route('/{id}/documentList', name: 'app_artisan_documents_liste', methods: ['GET'])]
    public function show(Artisan $artisan, DocumentsRepository $documentsRepository,Request $request): Response
    {
//      $this->checkIsTheSameArtisan($artisan); check if artisan = user
//      $idArtisan = $request->get('id');// recup id url

        //permet l'affiage du template avec dropdown filtre doc : id Artisan ou nom client
        return $this->render('contenus/_listeDocArtisans.html.twig');

    }


//....................................
//.............................................................  loader un document

//    #[Route('/{id}/documentLoading', name: 'app_artisan_document_loading', methods: ['GET', 'POST'])]
//    public function documentLoadding(Request $request, Artisan $artisan, EntityManagerInterface $entityManager, Documents $documents): Response
//    {
//
//        $form2 = $this->createFormBuilder($documents)
//            ->add('size')
//            ->add('typo')
//            ->add('document')
//            ->add('titreDefault')
//            ->add('save', SubmitType::class, ['label' => 'Ajout document'])
//            ->getForm();
//        return $this->render('_documentArtisans.html.twig', [
//            'artisans' => $artisan,
////                'form2' => $form2,
//// return $this->render('contenus/_loadingDoc.html.twig');
//        ]);
//
//    }

//    #[Route('/{id}/documentLoader', name: 'app_artisan_document_loader', methods: ['GET', 'POST'])]
//    public function documentLoader(Request $request, Artisan $artisan, EntityManagerInterface $entityManager, Documents $documents): Response
//    {
//
//        $form2 = $this->createFormBuilder($documents)
//            ->add('size')
//            ->add('typo')
//            ->add('document')
//            ->add('titreDefault')
//
//            ->add('save', SubmitType::class, ['label' => 'Ajout document'])
//            ->getForm();
//
//        return $this->redirectToRoute('app_artisan_document_loader', [
//            'artisans' => $artisan,
//            'form2' => $form2,
//        ]);
//    }



// ..................................A supprimer si tjr pas utilisee ................... ( Menu/Projet à accueil projet)
    #[Route('/{id}/documentListeProjet', name: 'app_artisan_documents_listep', methods: ['GET'])]
    public function showDocPjt(Artisan $artisan, Request $request): Response
    {
//      $this->checkIsTheSameArtisan($artisan); check if artisan = user
        $idArtisan = $request->get('id');// recup id url

        return $this->render('contenus/_projetArtisans.html.twig', [
            'id' => $idArtisan,
        ]);
    }


 //...............................................................................................  page generale projet
    #[Route('/{id}/{projet}/{value}', name: 'app_artisan_accueilPjt', methods: ['GET', 'POST'])]
    public function indexProjet(Artisan $artisan,ProjetRepository $projetRepository,TacheRepository $tacheRepository,Request $request): Response
    {
        $id = $artisan->getId();
        $artisans = $artisan;
        $pjt = $request->get('projet');

        if ($pjt) {

            //.................................................. page recherche de Taches/ id projet

            $idProjet = $request->get('value');
            $tacheList = [];

            if ($idProjet) {
                $tacheList = $tacheRepository->findPjtByIdPjt($idProjet); //.......dql depuis projet
            }

            //................................................. page recherche de Projet/ id artisan

            $idArtisan = $artisan->getId();
            $projetList = $projetRepository->findProjetByNomClient($idArtisan); //dql depuis document


            //....................................  recherche de Projet/  searchValue:: Class 'search'

            $search = new SearchFormType();
            $formSearch = $this->createForm(SearchFormType::class, $search);
            $formSearch->handleRequest($request);
            if ($formSearch->isSubmitted() && $formSearch->isValid()) {
                $search = $formSearch->get('searchValue')->getData();

                // utilisation du service ci-dessous qd il fonctionnera
                //$getResult=$this->searchFunction->getResultSearch($projetList,$search);


                //  loop in array of array + test itération/ valeur de $search
                // version avec Objet de Class :  property_exists() ou get_object_vars()
                //&& strpos($value, $search) !== FALSE
                //$properties = get_object_vars($objetPjt);
                //$properties3 = property_exists($objetPjt, $search)

                $listeFiltree = [];
                foreach ($projetList as $objetPjt) {
                    dump($objetPjt);
                    $keyProperties = property_exists($objetPjt, 'id');// trouve id dès 2nd itération
                    dump($keyProperties);

                    $properties = get_object_vars($objetPjt);// result: []
                    dump($properties);
//                    die();


                    foreach ($objetPjt as $key=>$propertySearch) {

                            dump($key);

                    }

                    foreach ($objetPjt as $property) {
                        dump($property);

                        //$properties3 = property_exists($property, $search);
                        //dump($properties3);
                        if ($property === $search) {
                            $listeFiltree[] = $objetPjt;
                            break; // arrêt de la boucle
                        }
                    }
                }
                //dump($listeFiltree);

//                    foreach ($value as $k => $field) {
//                        // Vérifie si $field est une chaîne de caractères
//                        if (is_string($field) && strpos($field, $search) !== FALSE) {
//                            return $field;
//                        }
//                        dump($field);
//                    }


            }


            return $this->render('pages/espace_artisan.html.twig', [
                'id' => $id,
                'artisans' => $artisans,
                'listePjt' => $projetList,
                'listeTaches' => $tacheList,
                'formSearch' => $formSearch,
//                'search'=>$value,
//                'mavaleur' => $search,
            ]);
        }
        return $this->render('pages/espace_artisan.html.twig', [
            'artisans' => $artisans,
        ]);
    }


//.........................................................................................  coordonnee form changement
    #[Route('{id}/change_coordonnees/', name: 'app_artisan_change_coordonnees', methods: ['GET', 'POST'])]
    public function artisanChangeCoordonnees(Request $request, Artisan $artisan, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArtisanType::class, $artisan);
        $form->handleRequest($request);
        $form->getData();
        $entityManager->persist($artisan);
        if ($form->isSubmitted() && $form->isValid()) {
            $id = $artisan->getId();
            $form->getData();
            $entityManager->persist($artisan);
            $entityManager->flush();
            $this->addFlash('success', 'vos modification sont prises en compte');
            return $this->redirectToRoute('app_artisan_accueil', [
                'id' => $id
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contenus/modifCoordoArtisans.html.twig', [
            'artisans' => $artisan,
            'form' => $form,
        ]);
    }

    private function checkIsTheSameArtisan(Artisan $artisan): void
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($artisan !== $user->getArtisan()) {
            throw $this->createAccessDeniedException("Vous n'êtes pas encore enregistré");
        }
    }
}


