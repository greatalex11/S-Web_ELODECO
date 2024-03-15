<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Entity\Client;
use App\Entity\User;
use App\Form\ArtisanType;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use TheSeer\Tokenizer\TokenCollection;

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

        //création de la partie dynamique du formulaire en fonction du choix artisan/ client : ne marche pas/ submission
//        if ($choice === "Artisan") {
//            $artisan = new Artisan();
//            $formCusto = $this->createFormBuilder($artisan)
//                ->add('nom_etablissement', TextType::class, ['label' => 'Nom de l\établissement'])
//                ->add('raison_sociale', TextType::class, ['label' => 'Raison sociale'])
//                -> add('save', SubmitType::class, ['label' => 'Create Task'])
//                ->getForm();
//        }

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

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('elodeco@gmail.com', 'admin'))
                    ->to($user->getEmail())
                    ->subject('Merci de confirmer votre Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            // si registerFORM VALIDE on part dans perso au lieu de /_profile
           // à cette étape, enregistrement dans user du Role et Info perso Client si Client, Ets si Ets
            if ($choice === "Artisan") {
                $artisan = new Artisan();
                $user->setArtisan($artisan);
                $user->setRoles(["artisan"]);
                $nomEts=$form->get('nom_etablissement')->getData();
                $artisan->setNomEtablissement($nomEts);
                $raisonSociale= $form->get('raison_sociale')->getData();
                $artisan->setRaisonSociale($raisonSociale);
                $entityManager->persist($artisan);

            }

            if ($choice === "Client") {
                $client = new Client();
                $user->setRoles(["client"]);
                $user->setClient($client);
                $nomClient=$form->get('nom')->getData();
                $client->setNom($nomClient);
                $prenomClient= $form->get('prenom')->getData();
                $client->setPrenom($prenomClient);
                $entityManager->persist($client);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());

        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));
            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');
        //$this-> getUser()->setIsVerified(1);

   // app_register : on reste dans le registerform après le check email
        return $this->redirectToRoute('app_register');
    }
}
