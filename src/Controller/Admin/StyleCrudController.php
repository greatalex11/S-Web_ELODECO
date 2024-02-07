<?php

namespace App\Controller\Admin;

use App\Entity\Contenus;
use App\Entity\Style;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\TextAlign;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StyleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Style::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_NEW, Action::SAVE_AND_RETURN)
            ->add(Crud::PAGE_NEW, Action::SAVE_AND_CONTINUE);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Mes styles')
            ->setEntityLabelInSingular('Mon style')
            ->setAutofocusSearch();
//            ->setDefaultSort(['updatedAt' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {

        if ($pageName !== Action::NEW) {
            yield FormField::addTab("Styles");

            yield SlugField::new('slug')->setTargetFieldName('titre2');
            yield TextField::new('titre1')->setLabel('Petit titre supérieur');
            yield TextField::new('titre2')->setLabel('Titre du style');
            yield TextField::new('attribut1')->setLabel('attribut1');
            yield TextField::new('attribut2')->setLabel('attribut2');
            yield TextField::new('attribut3')->setLabel('attribut3');

            yield TextEditorField::new('texte1')->setLabel('Première description')
                ->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
            yield CollectionField::new('liste')->hideOnIndex();
            yield TextEditorField::new('texte2')->setLabel('Seconde description')
                ->hideOnIndex()->setTemplatePath('fields/raw.html.twig');

            yield CollectionField::new('image')->useEntryCrudForm(ImageCrudController::class)
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setColumns(12)
                ->setTemplatePath('fields/images.html.twig');

        }


        yield BooleanField::new('publier')->renderAsSwitch();
//        yield DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Dernière modification');
    }
}




                /*
                public function configureFields(string $pageName): iterable
                {
                    return [
                        IdField::new('id'),
                        TextField::new('title'),
                        TextEditorField::new('description'),
                    ];
                }
                */

