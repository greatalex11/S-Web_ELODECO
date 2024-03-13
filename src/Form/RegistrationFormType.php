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
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    private $requestStack;

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

        // dynamisation du formulaire suivant le param de l'url - artisan ou client.
         $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event):void {
             $form = $event->getForm();
             $request = $this->requestStack->getCurrentRequest();

             if ($request->query->has('choice')) {
                 $choice = $request->query->get('choice');
                 switch ($choice) {
                     case 'Artisan':
                         $form->add('nom_etablissement', TextType::class, ['label' => 'Nom de l\'établissement']);
                         $form->add('$raison_sociale', TextType::class, ['label' => '$raison_sociale']);
                         break;
                     case 'Client':
                         $form->add('prenom', TextType::class, ['label' => 'Votre prenom']);
                         $form->add('nom', TextType::class, ['label' => 'Votre nom']);
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
