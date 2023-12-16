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
#[Route('/espaceClient')]
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


////    #[IsGranted("ROLE_CLIENT")]
    #[Route('/{id} ', name: 'app_client_show', methods: ['GET'])]
    public function show(): Response
    {
//        Client $clients
//        $client= $clients->getId();
//        {id}
//        $this->checkIsTheSameClient($client);
        return $this->render('pages/espace_client.html.twig', [
//            'client' => $client,
        ]);

//        return $this->render('client/show.html.twig', [
//            'client' => $client,
//        ]);
    }
//
//
////    #[IsGranted("ROLE_CLIENT")]
//    #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
//    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
//    {
////        $this->checkIsTheSameClient($client);
//        $form = $this->createForm(ClientType::class, $client);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->flush();
//
//            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->render('client/edit.html.twig', [
//            'client' => $client,
//            'form' => $form,
//        ]);
//    }



//
//    #[Route('/', name: 'app_client_index', methods: ['GET'])]
//    public function index(ClientRepository $clientRepository): Response
//    {
//        return $this->render('client/index.html.twig', [
//            'clients' => $clientRepository->findAll(),
//        ]);
//    }



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
