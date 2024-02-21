<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Entity\Documents;
use App\Entity\User;
use App\Form\ArtisanType;
use App\Form\DocumentsType;
use App\Repository\DocumentsRepository;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ARTISAN')]
#[Route('/artisan_accueil')]
class ArtisanController extends AbstractController
{
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

    #[Route('/{id}/{doc}', name: 'app_artisan_accueilDoc', methods: ['GET'])]
    public function indexDoc(Artisan $artisan,DocumentsRepository $documentsRepository ,Request $request): Response
    {
////      $polo=['id'=>$artisans->getId(), 'nom'=>$artisans->getNomGerant(), '$prenom'=>$artisans->getPrenomGerant()];

        $id=$artisan->getId();
        $artisans = $artisan;

        $doc = $request->get('doc');
       if ($doc) {
            $idArtisan=$artisan->getId();
            $documentIdArtisan=$documentsRepository-> findDocumentArtisan($idArtisan); //dql depuis document

//            $form2 = $this->createFormBuilder($documents) //$form2 doesn't exist dans documentLoading
//                ->add('size')
//                ->add('typo')
//                ->add('document')
//                ->add('titreDefault')
//                ->add('save', SubmitType::class, ['label' => 'Ajout document'])
//                ->getForm();

            return $this->render('pages/espace_artisan.html.twig', [
                'id' => $id,
                'artisans' => $artisans,
                'documentIdArtisan'=>$documentIdArtisan,
//                'form2'=>$form2,
            ] );
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


//.................................................................................................  loader un document

    #[Route('/{id}/documentLoading', name: 'app_artisan_document_loading', methods: ['GET', 'POST'])]
    public function documentLoadding(Request $request, Artisan $artisan, EntityManagerInterface $entityManager, Documents $documents): Response
    {

        $form2 = $this->createFormBuilder($documents)
            ->add('size')
            ->add('typo')
            ->add('document')
            ->add('titreDefault')
            ->add('save', SubmitType::class, ['label' => 'Ajout document'])
            ->getForm();
        return $this->render('_documentArtisans.html.twig', [
            'artisans' => $artisan,
//                'form2' => $form2,
// return $this->render('contenus/_loadingDoc.html.twig');
        ]);

    }

    #[Route('/{id}/documentLoader', name: 'app_artisan_document_loader', methods: ['GET', 'POST'])]
    public function documentLoader(Request $request, Artisan $artisan, EntityManagerInterface $entityManager, Documents $documents): Response
    {

        $form2 = $this->createFormBuilder($documents)
            ->add('size')
            ->add('typo')
            ->add('document')
            ->add('titreDefault')

            ->add('save', SubmitType::class, ['label' => 'Ajout document'])
            ->getForm();

        return $this->redirectToRoute('app_artisan_document_loader', [
            'artisans' => $artisan,
            'form2' => $form2,
        ]);
    }



// ......................................................................................  Menu/Projet à accueil projet
    #[Route('/{id}/documentListeProjet', name: 'app_artisan_documents_listep', methods: ['GET'])]
    public function showDocPjt(Artisan $artisan, Request $request): Response
    {
//      $this->checkIsTheSameArtisan($artisan); check if artisan = user
        $idArtisan = $request->get('id');// recup id url

        return $this->render('contenus/_projetArtisans.html.twig', [
            'id' => $idArtisan,
        ]);
    }


    #[Route('/{id}/{projet}/{value}', name: 'app_artisan_accueilPjt', methods: ['GET', 'POST'])]
    public function indexProjet(Artisan $artisan,ProjetRepository $projetRepository,Request $request): Response
    {
        $id=$artisan->getId();
        $artisans = $artisan;
        $pjt = $request->get('projet');

        if ($pjt) {
            $idArtisan=$artisan->getId();
            $projetList=$projetRepository-> findProjetByNomClient($idArtisan); //dql depuis document

//            foreach ($projetList as $intraList ){
//
//                foreach ($intraList as $key=>$values){
//                    if($values=='taches'){
//                        $taches=$values;
//                        dd($taches);
//                    }
//                }
//            }


            return $this->render('pages/espace_artisan.html.twig', [
                'id' => $id,
                'artisans' => $artisans,
                'listePjt'=>$projetList,

            ] );
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


