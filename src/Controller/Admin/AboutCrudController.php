<?php

namespace App\Controller\Admin;

use App\Entity\About;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AboutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return About::class;
    }
//    public function configureFilters(Filters $filters): Filters
//    {
//        return $filters
//            ->add('localite');
//    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_NEW, Action::SAVE_AND_RETURN)
            ->add(Crud::PAGE_NEW, Action::SAVE_AND_CONTINUE);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('A propos de moi')
            ->setEntityLabelInSingular('A propos de moi')
            ->setAutofocusSearch();
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            yield FormField::addTab("Ma vision"),
            yield IdField::new('id')->setDisabled(),
            yield TextField::new('visiot1')->setLabel('titre 1'),
            yield TextField::new('visiot2')->setLabel('titre 2')->hideOnIndex(),
            yield TextField::new('visioarg1')->setLabel('argument 1')->hideOnIndex(),
            yield TextField::new('visioarg2')->setLabel('argument 2')->hideOnIndex(),
            yield TextField::new('visiot3')->setLabel('titre 3')->hideOnIndex(),
            yield NumberField::new('visiochiffre1')->setLabel('chiffre 1')->hideOnIndex(),
            yield TextField::new('visioarg3')->setLabel('argument 3')->hideOnIndex(),
            yield TextEditorField::new('visiotexte1')->setLabel('texte 1')->hideOnIndex(),
            yield TextEditorField::new('visiotexte2')->setLabel('texte 2')->hideOnIndex(),
            yield TextField::new('visioarg4')->setLabel('argument 4')->hideOnIndex(),
            yield NumberField::new('visiochiffre2')->setLabel('chiffre 2')->hideOnIndex(),

            yield FormField::addTab("Les experts"),
            yield TextField::new('expertt1')->setLabel('Expert titre 1'),
            yield TextField::new('expertt2')->setLabel('Expert titre 2')->hideOnIndex(),
            yield TextField::new('expertt3')->setLabel('Temoignage titre 1')->hideOnIndex(),
            yield TextField::new('expertt4')->setLabel('Temoignage titre 1')->hideOnIndex(),

            yield FormField::addTab("Mon image & artisans"),
            yield CollectionField::new('image')->useEntryCrudForm(ImageCrudController::class)
                ->setLabel('Mon image')
                ->setHelp('titre important pour le référencementimage, artisan en 330x448, image métier en 285x281px environs')
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setColumns(10)
                ->setTemplatePath('fields/images.html.twig'),

            yield FormField::addTab("Mes artisans"),
            yield ArrayField::new('liste_artisan')->setLabel(' Liste des arguments')
                ->setHelp('1 titre pour l\'étape, 1 phrase d\'explication')
                ->setColumns(12)
                ->hideOnIndex(),


            yield FormField::addTab("Ce qu'ils font"),
            yield ArrayField::new('liste_t5')->setLabel(' Liste des arguments')
                ->setHelp('1 titre pour le metier')
                ->setColumns(12)
                ->hideOnIndex(),

        ];

    }

}
