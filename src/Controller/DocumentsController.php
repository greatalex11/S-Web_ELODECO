<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Documents;
use App\Entity\User;
use App\Form\DocumentsType;
use App\Repository\DocumentsRepository;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

//#[IsGranted("ROLE_CLIENT")]    &&&&             Manque le check projet id
#[Route('espace_perso/documents')]
class DocumentsController extends AbstractController
{
    private function checkIsTheSameClient(Client $client): void
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($client !== $user->getClient()) {
            throw $this->createAccessDeniedException("Vous n'êtes pas encore client");
        }
    }

    //ajout document par l'artisan
    #[Route('/{id}/edit', name: 'app_documents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TokenInterface $token, Documents $document, EntityManagerInterface $entityManager): Response
    {
        $idRequest = $request->get('id');
        $user = $token->getUser()->getUserIdentifier();
        $role = $token->getRoleNames();
        // essai : creation du formulaire dans DocumentsController puis rendu via ArtisanController
        // si id user == id requete
        if ($idRequest == $user) {
            $formLoadDoc = $this->createForm(DocumentsType::class, $document);
            $formLoadDoc->handleRequest($request);
            if ($formLoadDoc->isSubmitted() && $formLoadDoc->isValid()) {
                $entityManager->flush();
                $formLoadDoc->getData();
                $entityManager->persist($document);
                $entityManager->flush();
                $this->addFlash('success', 'Votre document est bien enregistré');

                // si l'utilisateur en cours = artisan
                if ($role == "artisan") {
                    return $this->redirectToRoute('app_artisan_accueilDoc', [
                        'id' => $idRequest,
                        'doc' => 'doc',
                        //passage du form+option puis traitement -> accueilDoc
                        'formType' => get_class($formLoadDoc),
//                        'formOptions' => $formLoadDoc->getConfig()->getOptions(),
                    ]);

                // si l'utilisateur en cours = client
                } else {
                    return $this->redirectToRoute('app_client_accueil', [
                        'id' => $idRequest,
                        'formLoadDoc' => $formLoadDoc,
                    ]);
                }
            }
        }
        // throw $this->createAccessDeniedException
        return $this->redirectToRoute('app_login', [
            'id' => $idRequest
        ]);
    }



//.......................................................................................................... doc Artisan
    #[Route('artisan/{id}', name: 'app_documents_artisan', methods: ['GET'])]
    public function docArtisan(DocumentsRepository $documentsRepository, Client $client): Response
    {
//        $this->miseEnCopie($client);
//        $this->checkIsTheSameClient($client);

        return $this->render('pages/espace_artisan.html.twig', [
//            'documents' => $documentsRepository->findAll(),
        'documents'=> 'ta mere'
        ]);
    }

    #[Route('/news/{slug}', name: 'app_documents_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $document = new Documents();
        $form = $this->createForm(DocumentsType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirectToRoute('app_documents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('documents/new.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }





//    #[Route('/{id}', name: 'app_documents_delete', methods: ['POST'])]
//    public function delete(Request $request, Documents $document, EntityManagerInterface $entityManager): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
//            $entityManager->remove($document);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('app_documents_index', [], Response::HTTP_SEE_OTHER);
//    }
}
