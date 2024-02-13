<?php

namespace App\Controller\Admin;

use App\Entity\Documents;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Date;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DocumentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Documents::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
//            IdField::new('id'),
            yield FormField::addTab("Nature"),
            yield SlugField::new('slug')->setTargetFieldName('titre'),
            yield TextField::new('titre'),
            yield ChoiceField::new('type')
                ->setChoices(Documents::TYPEDEDOCUMENT),
            yield TextEditorField::new('description'),
            yield ImageField::new('document')
                ->setBasePath('assets/documents/uploads')
                ->setUploadDir('public/assets/documents/uploads'),
//
//            yield TextField::new('documentsFile')
//                ->setLabel(false)
//                ->setFormType(VichImageType::class)
//                ->setFormTypeOptions([
//                    'allow_delete' => false,
//                ])
//                ->setColumns(12)
//                ->onlyOnForms(),




            yield FormField::addTab("Données du document"),
            yield DateField::new('date_peremption')
                ->renderAsChoice()
                ->setLabel('date de retrait du document')
                ->hideOnIndex(),

            yield TextField::new('TitreDefault')->hideOnIndex(),
            yield NumberField::new('size')->hideOnIndex(),
            yield TextField::new('typo')->hideOnIndex(),

//            yield FormField::addTab("Associé à quel projet?"),
////            yield AssociationField::new('projet')
//////                ->setFormTypeOption('choice_label', 'titre')
////                ->setFormTypeOption('by_reference', false)
////                ->autocomplete()
////                ->hideOnIndex(),

            yield FormField::addTab("Partager le document avec?"),
            yield ChoiceField::new('mise_en_copie')
                ->allowMultipleChoices()
                ->setChoices(Documents::MISEENCOPIE)
                ->hideOnIndex(),

        ];
      }
}
