<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Entity\User;
use App\Form\ArtisanType;
use App\Repository\DocumentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ARTISAN')]
#[Route('/artisan_accueil')]
class ArtisanController extends AbstractController
{

    #[Route('/{id}', name: 'app_artisan_accueil', methods: ['GET'])]
    public function index(Artisan $artisan): Response
    {
       $artisans = $artisan;
        return $this->render('pages/espace_artisan.html.twig', [
            'artisans' => $artisans,
        ]);
    }


    #[Route('/{id}/{doc}', name: 'app_artisan_accueilDoc', methods: ['GET'])]
    public function indexDoc(Artisan $artisan, DocumentsRepository $documentsRepository, Request $request): Response
    {
            $id=$artisan->getId();
//        $polo=[
//            'id'=>$artisans->getId(),
//            'nom'=>$artisans->getNomGerant(),
//         '$prenom'=>$artisans->getPrenomGerant()
//        ];

        $artisans = $artisan;
        $doc = $request->get('doc');
        if ($doc) {

            $this->redirectToRoute('app_documents_edit', [ 'id' => $id] );
//            $listDoc = "DOCUMENTS";
//            return $this->render('pages/espace_artisan.html.twig', [
//                'artisans' => $artisans,
//                'document' => $listDoc,
//              'polo'=>$polo,
//            ]);
        }
        return $this->render('pages/espace_artisan.html.twig', [
            'artisans' => $artisans,
        ]);
    }


    #[Route('/show/{id}', name: 'app_artisan_show', methods: ['GET'])]
    public function show(Artisan $artisan): Response
    {
//      $this->checkIsTheSameArtisan($artisan);
        $artisans = $artisan;
        return $this->render('contenus/coordonneesArtisans.html.twig', [
            'artisans' => $artisans,
        ]);
    }


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


