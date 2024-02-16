<?php

namespace App\Form;

use App\Entity\Documents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DocumentsType extends AbstractType
{

    //vichloader via champ document, titredefault,size et typo ; cf entity document
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('type')
//            ->add('titre')
//            ->add('description',TextareaType::class)
//            ->add('date_peremption')
//            ->add('mise_en_copie')
//            ->add('projet_id')
//            ->add('slug')

            ->add('size')
            ->add('typo')
            ->add('document')
            ->add('titreDefault')
//            ->add('Valider', SubmitType::class)
//            ->add('documentsFile', VichImageType::class, [
//                'required' => false
//            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documents::class,
        ]);
    }
}
