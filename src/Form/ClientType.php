<?php

namespace App\Form;

use App\Entity\Client;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('date_naissance')
            ->add('commentaire',TextareaType::class)
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
