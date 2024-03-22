<?php

namespace App\Form;

use App\Entity\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', HiddenType::class, [
                'empty_data' => ContactForm::MSGATRAITE,
            ])
            ->add('msgLu', HiddenType::class, [
                'empty_data' => 'false',
            ])
            ->add('nom')
            ->add('prenom')
            ->add('telephone', TextType::class, ['attr' => ['maxlength' => 10]])
            ->add('email', EmailType::class)
            ->add('sujet', TextType::class, ['attr' => ['maxlength' => 50]])
            ->add('message', TextareaType::class, ['attr' => [
                'maxlength' => 350,
                'style' => 'height: 200px',
            ]])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer le message'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,

        ]);

    }
}
