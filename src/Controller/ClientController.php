<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

//#[IsGranted("ROLE_CLIENT")]
#[Route('/client_accueil')]
class ClientController extends AbstractController
{
    private function checkIsTheSameClient(Client $client): void
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($client !== $user->getClient()) {
            throw $this->createAccessDeniedException("Vous n'êtes pas encore client");
        }
    }

    #[Route('/{id}', name: 'app_client_accueil', methods: ['GET'])]
    public function index(ClientRepository $clientRepository, Client $client): Response
    {

        $form = $this->createForm(ClientType::class);

        $clients=$client;
        return $this->render('pages/espace_client.html.twig', [
            'form' => $form,
            'clients' => $clients,
        ]);
    }


//    #[IsGranted("ROLE_CLIENT")]
    #[Route('/show/{id} ', name: 'app_client_show', methods: ['GET'])]
    public function show(Client $theClient, User $user,ClientRepository $clientRepository): Response
    {
        $form = $this->createForm(ClientType::class);
        $client= $theClient;
        $mail=$user->getEmail();
//        $this->checkIsTheSameClient($client);
        return $this->render('contenus/coordonnees.html.twig', [
            'clients' => $client,
//            'form' => $form,
            'mail'=> $mail,
        ]);

    }
//
//
//    #[IsGranted("ROLE_CLIENT")]
    #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $theClient,User $user, EntityManagerInterface $entityManager): Response
    {
        $this->checkIsTheSameClient($theClient);
        $form = $this->createForm(ClientType::class);
        $client= $theClient;
        $mail=$user->getEmail();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $id=$client->getId();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_client_show', [
                'id'=>$id,
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contenus/coordonnees.html.twig', [
            'clients' => $client,
            'form' => $form,
            'mail'=> $mail,
        ]);
    }








//    #[Route('/new', name: 'app_client_new', methods: ['GET', 'POST'])]
//    public function new(Request $request, EntityManagerInterface $entityManager): Response
//    {
//        $client = new Client();
//        $form = $this->createForm(ClientType::class, $client);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->persist($client);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->render('client/new.html.twig', [
//            'client' => $client,
//            'form' => $form,
//        ]);
//    }




//    #[Route('/{id}', name: 'app_client_delete', methods: ['POST'])]
//    public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
//            $entityManager->remove($client);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
//    }
}
