<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Documents;
use App\Entity\User;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Repository\DocumentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted("ROLE_CLIENT")]
#[Route('/client_accueil')]
class ClientController extends AbstractController
{
    #[Route('/{id}', name: 'app_client_accueil', methods: ['GET'])]
    public function index(ClientRepository $clientRepository, Client $client): Response
    {
        $form = $this->createForm(ClientType::class);
        $clients = $client;
        return $this->render('pages/espace_client.html.twig', [
            'form' => $form,
            'clients' => $clients,
        ]);
    }

//.........................................................................................  coordonnee form changement
    #[Route('{id}/change_coordonnees/', name: 'app_client_change_coordonnees', methods: ['GET', 'POST'])]
    public function clientChangeCoordonnees(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        $form->getData();
        $entityManager->persist($client);
        if ($form->isSubmitted() && $form->isValid()) {
            $id = $client->getId();
            $form->getData();
//            emailverifier ???
//            $email=$form->get('email')->getData();
//            $User->setmail($email);
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash('success', 'vos modification sont prises en compte');
            return $this->redirectToRoute('app_client_accueil', [
                'id' => $id
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contenus/modifCoordoClients.html.twig', [
            'clients' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/{doc}', name: 'app_client_accueilDoc', methods: ['GET', 'POST'])]
    public function indexDoc(Client $client, DocumentsRepository $documentsRepository, EntityManagerInterface $entityManager, SluggerInterface $slugger, Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->getClient() != $client) {
            throw $this->createAccessDeniedException("Vous n'êtes pas enregistré");
        }
        $id = $client->getId();
        $clients = $client;
        $doc = $request->get('doc');
        if ($doc) {
            /** @var documents $documents */
//            $documents = new Documents();
//            $formDocClient = $this->createForm(DocumentsTypeClient::class, $documents, ['client' => $client]);
//            $formDocClient->handleRequest($request);
//            if ($formDocClient->isSubmitted() && $formDocClient->isValid()) {
//                $entityManager->persist($documents);
//
//                $entityManager->flush();
//                $this->addFlash('success', 'Votre document est bien enregistré');
//                return $this->redirectToRoute('app_client_accueilDoc', ['id' => $id, 'doc' => $doc]);
//            }

            $idClient = $id;
            $documentIdClient = $documentsRepository->findDocumentClient($idClient); //dql depuis document

            if (!$documentIdClient) {
                $this->addFlash(
                    'notice',
                    'Vous n\'avez pas encore de document en ligne.'
                );
            }

            //formulaire search document
//            $search = new SearchFormType();
//            $formSearch = $this->createForm(SearchFormType::class, $search);
//            $formSearch->handleRequest($request);
//            if ($formSearch->isSubmitted() && $formSearch->isValid()) {
//                $search = $formSearch->get('searchValue')->getData();
//                //search fonction à faire
//            }

            return $this->render('pages/espace_client.html.twig', [
                'id' => $id,
                'clients' => $clients,
                'documentIdClient' => $documentIdClient,
//                'formLoadDocClient' => $formDocClient,
            ]);
        }

        return $this->render('pages/espace_client.html.twig', [
            'client' => $client,
        ]);
    }

    //---------------------------------------------  MANQUE CONTROLE PROJET

    #[Route('/show/{id} ', name: 'app_client_show', methods: ['GET'])]
    public function show(Client $theClient, User $user, ClientRepository $clientRepository): Response
    {
        $form = $this->createForm(ClientType::class);
        $client = $theClient;
        $mail = $user->getEmail();
//        $this->checkIsTheSameClient($client);
        return $this->render('contenus/coordonnees.html.twig', [
            'clients' => $client,
            'form' => $form,
            'mail' => $mail,
        ]);

    }


//    #[IsGranted("ROLE_CLIENT")]

    #[IsGranted("ROLE_CLIENT")]
    #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $theClient, User $user, EntityManagerInterface $entityManager): Response
    {
        $this->checkIsTheSameClient($theClient);
        $client = $theClient;
        $mail = $user->getEmail();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $client->getId();
            $form->getData();
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash('success', 'vos modification sont prises en compte');
            return $this->redirectToRoute('app_client_show', [
                'id' => $id,
            ], Response::HTTP_SEE_OTHER);
        }
        return $this->render('contenus/coordonnees.html.twig', [
            'clients' => $client,
            'form' => $form,
            'mail' => $mail,
        ]);
    }
//
//

    private function checkIsTheSameClient(Client $client): void
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($client !== $user->getClient()) {
            throw $this->createAccessDeniedException("Vous n'êtes pas encore client");
        }
    }

}
