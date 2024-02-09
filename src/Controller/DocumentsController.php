<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Documents;
use App\Entity\User;
use App\Form\DocumentsType;
use App\Repository\DocumentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

//    private function miseEnCopie(DocumentsRepository $documentsRepository, $id): void
//    {//
//        $miseencopie = $documentsRepository->findBy('id'=$id);
//        if ($miseencopie !== "client" ) {
//            throw $this->createAccessDeniedException("Document pas encore accessible");
//        }
//    }
//
//    #[Route('/{id}', name: 'app_documents_index', methods: ['GET'])]
//    public function index(DocumentsRepository $documentsRepository, Client $client): Response
//    {
////        $this->miseEnCopie($client);
//        $this->checkIsTheSameClient($client);
//
//        return $this->render('contenus/documents.html.twig', [
//            'documents' => $documentsRepository->findAll(),
//        ]);
//    }

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

    #[Route('/{id}', name: 'app_documents_show', methods: ['GET'])]
    public function show(Documents $document): Response
    {
        return $this->render('documents/show.html.twig', [
            'document' => $document,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_documents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Documents $document, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DocumentsType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_documents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('documents/edit.html.twig', [
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
