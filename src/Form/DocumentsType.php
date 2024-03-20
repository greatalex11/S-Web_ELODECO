<?php

namespace App\Form;

use App\Entity\Documents;
use App\Entity\Projet;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DocumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('documentsFile', VichImageType::class, [
                'label' => 'Votre document (PDF de préférence)',
                'required' => false,
                'download_uri' => false,
                'allow_delete' => false,
//               'constraints' => [
//                   new File([
//                        'maxSize' => '1024k',
//
//                        'mimeTypes' => [                 'application/pdf',
//                           'application/x-pdf',
//                       ],
//                        'mimeTypesMessage' => 'Please upload a valid PDF document',
//                    ])
//                ],
            ])
            ->add('titre', TextType::class)
            // ->add('size',NumberType::class)

            ->add('type', ChoiceType::class, ['choices' => Documents::TYPEDEDOCUMENT])
            ->add('projet', EntityType::class, [
                'class' => Projet::class,
                'query_builder' => function (EntityRepository $er) use ($options): QueryBuilder {
                    return $er->createQueryBuilder('p')
                        ->leftJoin('p.taches', "taches")
                        ->where('taches.artisan = :artisan')
                        ->setParameters([
                            'artisan' => $options['artisan']
                        ]);
                },
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrement',
                'attr' => ['class' => 'center thm-btn contact-page__btn']]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documents::class,
            'artisan' => null,
        ]);
    }


//    //vichloader via champ document, titredefault,size et typo ; cf entity document
//    public function buildForm(FormBuilderInterface $builder, array $options): void
//    {
//        $builder
//            ->add('titre', TextType::class, [
//                'label' => false,
//            ])
//            //Some add fields
//            ->add('document', VichImageType::class, [
//                'required' => false
//            ]);
//    }
//
//    public function configureOptions(OptionsResolver $resolver): void
//    {
//        $resolver->setDefaults([
//            'data_class' => Documents::class,
//        ]);
//    }

}
