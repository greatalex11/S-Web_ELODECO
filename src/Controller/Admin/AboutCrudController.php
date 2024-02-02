<?php

namespace App\Controller\Admin;

use App\Entity\About;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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
            ->setEntityLabelInPlural('Mes pages a propos')
            ->setEntityLabelInSingular('Ma page a propos')
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
            yield TextField::new('expertt1')->setLabel('titre 1'),
            yield TextField::new('expertt2')->setLabel('titre 2')->hideOnIndex(),
            yield TextField::new('expertt3')->setLabel('titre 3')->hideOnIndex(),
            yield TextField::new('expertt4')->setLabel('titre 4')->hideOnIndex(),

            yield FormField::addTab("Mon image"),
            yield CollectionField::new('image')->useEntryCrudForm(ImageCrudController::class)
                ->setLabel('Mon image')
                ->setHelp('titre de \'image important pour le référencement')
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setColumns(10)
                ->setTemplatePath('fields/images.html.twig'),
        ];
    }

}
