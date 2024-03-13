<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\RequestStack;

class RegistrationFormType extends AbstractType
{
    //injection du service 'resquestack'
    public function __construct(
        protected RequestStack $requestStack,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
     {
        //formulaire principal
        $builder
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'J\'accepte les conditions générales',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre mode de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mode de passe doit avoir au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                    ]),
                ],
            ]);

         /**
          * @Route("/register/{choice}", name="app_register")
          */

         // dynamisation du formulaire suivant le param de l'url - artisan ou client.
         $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

             $form = $event->getForm();
             $request = $this->requestStack->getCurrentRequest();
             //mapped 'false' car liés a Artisan ou Clien, pas User
             if ($request) {
                 $choice = $this->requestStack->getMainRequest()->getPathInfo();
                 switch ($choice) {
                     case '/register/Artisan':
                         $form->add('nom_etablissement', TextType::class, [
                             'label' => 'Nom de l\'établissement',
                             'mapped' => false,
                             ]);
                         $form->add('raison_sociale', TextType::class, [
                             'label' => '$raison_sociale',
                             'mapped' => false,
                         ]);
                         break;

                     case '/register/Client':
                         $form->add('prenom', TextType::class, [
                             'label' => 'Votre prenom',
                             'mapped' => false,
                             ]);
                         $form->add('nom', TextType::class, [
                             'label' => 'Votre nom',
                             'mapped' => false,
                             ]);
                         break;
                 }
             }
         });
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
