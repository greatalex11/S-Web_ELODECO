<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('numero_rue')
            ->add('rue')
            ->add('code_postal')
            ->add('localite')
            ->add('tel_fix')
            ->add('tel_portable')

// a voir dans le controller pour emailverifier ou webpaster
//            ->add('email', EmailType::class, [
//                 'label' => 'email',
//                 'mapped' => false,
//             ])

            ->add('date_naissance', BirthdayType::class, [
                'placeholder' => 'Sélectionnez une valeur',
                'years' => range(date('Y') - 90, date('Y')),
            ])
            ->add('statusMarital', ChoiceType::class, [
                'choices' => [
                    'Status marital' => [
                        'célibataire' => 'celibataire',
                        'marié(e)' => 'marié(e)',
                        'union libre' => 'union libre',
                        'séparé(e)' => 'séparé(e)',
                        'divorsé(e)' => 'divorsé(e)',
                        'veuf/ veuve' => 'veuf/ veuve',
                    ]]])
            ->add('nom_conjoint')
            ->add('prenom_conjoint')
            //->add('commentaire',TextareaType::class)
            ->add('Valider', SubmitType::class)
//            ->add('status')
//            ->add('user')
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
