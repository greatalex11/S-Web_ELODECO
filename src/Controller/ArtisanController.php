<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Entity\Client;
use App\Entity\User;
use App\Form\ArtisanType;
use App\Repository\ArtisanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/artisan_accueil')]
class ArtisanController extends AbstractController
{

    private function checkIsTheSameArtisan(Artisan $artisan): void
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($artisan !== $user->getArtisan()) {
            throw $this->createAccessDeniedException("Vous n'êtes pas encore enregistré");
        }
    }

    #[Route('/{id}', name: 'app_artisan_accueil', methods: ['GET'])]
    public function index(Artisan $artisan): Response
    {
//       $form = $this->createForm(ClientType::class);
        $artisans=$artisan;
        return $this->render('pages/espace_artisan.html.twig', [
//            'form' => $form,
            'artisans' => $artisans,
        ]);
    }

    #[Route('/show/{id}', name: 'app_artisan_show', methods: ['GET'])]
    public function show(Artisan $artisan): Response
    {
//        $this->checkIsTheSameArtisan($artisan);
        $artisans=$artisan;
        return $this->render('contenus/coordonneesArtisans.html.twig', [
            'artisans' => $artisans,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_artisan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artisan $artisan, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArtisanType::class, $artisan);
        $form->handleRequest($request);
        $form->getData();
        $entityManager->persist($artisan);
        if ($form->isSubmitted() && $form->isValid()) {
            $id=$artisan->getId();
            $form->getData();
            $entityManager->persist($artisan);
            $entityManager->flush();
            $this->addFlash('success', 'vos modification sont prises en compte');
            return $this->redirectToRoute('app_artisan_show', [
                'id'=>$id
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contenus/coordonneesArtisans.html.twig', [
            'artisans' => $artisan,
            'form' => $form,
        ]);
    }

//    #[Route('/', name: 'app_artisan_accueil', methods: ['GET'])]
//    public function index(ArtisanRepository $artisanRepository): Response
//    {
//        return $this->render('pages/espace_artisan.html.twig', [
//            'artisans' => $artisanRepository->findAll(),
//        ]);
//    }

//    #[Route('/new', name: 'app_artisan_new', methods: ['GET', 'POST'])]
//    public function new(Request $request, EntityManagerInterface $entityManager): Response
//    {
//        $artisan = new Artisan();
//        $form = $this->createForm(ArtisanType::class, $artisan);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->persist($artisan);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('app_artisan_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->render('artisan/new.html.twig', [
//            'artisan' => $artisan,
//            'form' => $form,
//        ]);
//    }











//    #[Route('/{id}', name: 'app_artisan_delete', methods: ['POST'])]
//    public function delete(Request $request, Artisan $artisan, EntityManagerInterface $entityManager): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$artisan->getId(), $request->request->get('_token'))) {
//            $entityManager->remove($artisan);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('app_artisan_index', [], Response::HTTP_SEE_OTHER);
//    }
}
