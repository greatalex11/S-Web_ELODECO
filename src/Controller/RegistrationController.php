<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Entity\Client;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    //formulaire choix : Artisan ou Client
    #[Route('/register/choice', name: 'app_register_choice')]
    public function registerChoice(Request $request): Response
    {
        return $this->render('registration/registerChoice.html.twig', [
        ]);
    }

    #[Route('/register/{choice}', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, string $choice): Response
    {
        /** @var artisan $artisan */

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();


            // si registerFORM VALIDE on part dans perso au lieu de /_profile
            // à cette étape, enregistrement dans user du Role et Info perso Client si Client, Ets si Ets
            if ($choice === "Artisan") {
                $artisan = new Artisan();
                $user->setArtisan($artisan);
                $user->setRoles(["ROLE_ARTISAN"]);
                $nomEts = $form->get('nom_etablissement')->getData();
                $artisan->setNomEtablissement($nomEts);
                $raisonSociale = $form->get('raison_sociale')->getData();
                $artisan->setRaisonSociale($raisonSociale);
                $entityManager->persist($artisan);

            }

            if ($choice === "Client") {
                $client = new Client();
                $user->setRoles(["ROLE_CLIENT"]);
                $user->setClient($client);
                $nomClient = $form->get('nom')->getData();
                $client->setNom($nomClient);
                $prenomClient = $form->get('prenom')->getData();
                $client->setPrenom($prenomClient);
                $entityManager->persist($client);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('tamere@lapute.com', 'test'))
                    ->to($user->getEmail())
                    ->subject('Veuillez confirmer votre email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email
            return $this->redirectToRoute('app_login', ["check_email" => true]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $userRepository): Response
    {
        $id = $request->query->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_login');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_login');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));
            $this->addFlash('info', "Un nouvel email de validation vous a été envoyé, veuillez cliquer sur le lien de validation");
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('tamere@lapute.com', 'test'))
                    ->to($user->getEmail())
                    ->subject('Veuillez confirmer votre email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            return $this->redirectToRoute('app_login');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Votre email a été vérifié avec succès. Vous pouvez désormais vous connecter');

        return $this->redirectToRoute('app_login');
    }
}
