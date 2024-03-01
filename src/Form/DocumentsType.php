<?php

namespace App\Form;

use App\Entity\Documents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DocumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('documentsFile',  FileType::class, [
                'label' => 'Votre document (PDF file)',
                'mapped' => true,
                'required' => true,
                'constraints' => [
                    new documents([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documents::class,
        ]);
    }


//    //vichloader via champ document, titredefault,size et typo ; cf entity document
//    public function buildForm(FormBuilderInterface $builder, array $options): void
//    {
//        $builder
//
////            ->add('titre', TextType::class, [
////                'label' => false,
////
////            ])
////            //Some add fields
////            ->add('$documentsFile', VichImageType::class, [
////                'required' => false
////            ]);
//
//
//    }
//
//    public function configureOptions(OptionsResolver $resolver): void
//    {
//        $resolver->setDefaults([
//            'data_class' => Documents::class,
//        ]);
//    }



}
